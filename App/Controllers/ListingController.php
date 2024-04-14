<?php

namespace JWord\App\Controllers;

use JWord\Framework\Database;
use JWord\Framework\Session;
use JWord\Framework\Validation;
use JWord\Framework\Authorization;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require base_path('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

        load_view('listings/index', ['listings' => $listings]);
    }

    public function create()
    {
        load_view('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
        }

        load_view('listings/show', ['listing' => $listing]);
    }

    public function store()
    {
        $allowed_fields = [
            'title',
            'description',
            'salary',
            'tags',
            'company',
            'address',
            'city',
            'state',
            'phone',
            'email',
            'requirements',
            'benefits',
            'user_id'
        ];

        $new_listing_data = array_intersect_key($_POST, array_flip($allowed_fields));

        $new_listing_data = array_map('sanitize', $new_listing_data);

        $new_listing_data['user_id'] = Session::get('user')['id'];

        $errors = [];
        $required_fields = ['title', 'description', 'salary', 'email', 'city', 'state'];
        foreach ($required_fields as $field) {
            if (empty($new_listing_data[$field]) || !Validation::string($new_listing_data[$field])) {
                $errors[$field] = ucfirst($field) . " is required";
            }
        }
        if (!empty($errors))
            load_view('listings/create', ['errors' => $errors, 'listing' => $new_listing_data]);
        else {
            $fields = implode(', ', array_keys($new_listing_data));
            $placeholders = implode(', :', array_keys($new_listing_data));
            $query = "INSERT INTO listings ({$fields}) VALUES(:{$placeholders})";

            $this->db->query($query, $new_listing_data);

            // set success message
            Session::set_flash_message('success_message', 'Listing created successfully!');

            redirect('/workopia/listings');
        }
    }

    /**
     * Remove listing
     *
     * @param mixed $params
     * 
     * @return [type]
     * 
     */
    public function destroy($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];

        // get user information
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // check if listing exists
        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
        }

        // check if user owns listing
        if (!Authorization::is_owner($listing->user_id)) {
            Session::set_flash_message('error_message', 'You do not have permission to delete this listing');
            return redirect('/workopia/listings/' . $listing->id);
        }

        $listing = $this->db->query('DELETE FROM listings WHERE id = :id', ['id' => $id]);

        // set success message
        Session::set_flash_message('success_message', 'Listing deleted successfully');

        redirect('/workopia/listings');
    }

    /**
     * Show edit form
     *
     * @param mixed $params
     * 
     * @return [type]
     * 
     */
    public function edit($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
        }

        // check if listing belongs to user
        if (!Authorization::is_owner($listing->user_id)) {
            Session::set_flash_message('error_message', 'You do not have permission to update this listing');
            return redirect('/workopia/listings/' . $listing->id);
        }

        load_view('listings/edit', ['listing' => $listing]);
    }

    /**
     * Update listing
     *
     * @param mixed $params
     * 
     * @return void 
     * 
     */
    public function update($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];

        $allowed_fields = [
            'title',
            'description',
            'salary',
            'tags',
            'company',
            'address',
            'city',
            'state',
            'phone',
            'email',
            'requirements',
            'benefits'
        ];

        // check if listing exists
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
        }

        // check if listing belongs to user
        if (!Authorization::is_owner($listing->user_id)) {
            Session::set_flash_message('error_message', 'You do not have permission to update this listing');
            return redirect('/workopia/listings/' . $listing->id);
        }

        $update_values = [];

        $update_values = array_intersect_key($_POST, array_flip($allowed_fields));

        $update_values = array_map('sanitize', $update_values);

        $required_fields = ['title', 'description', 'salary', 'email', 'city', 'state'];

        $errors = [];
        foreach ($required_fields as $field) {
            if (empty($update_values[$field]) || !Validation::string($update_values[$field])) {
                $errors[$field] = ucfirst($field) . " is required";
            }
        }

        if (!empty($errors)) {
            load_view('listings/edit', ['errors' => $errors, 'listing' => $listing]);
            exit;
        } else {
            $update_fields = [];

            foreach (array_keys($update_values) as $field) {
                $update_fields[] = "{$field} = :{$field}";
            }

            $update_fields = implode(', ', $update_fields);

            $update_values['id'] = $id;
            $query = "UPDATE listings SET {$update_fields} WHERE id = :id";

            $this->db->query($query, $update_values);

            // set success message
            Session::set_flash_message('success_message', 'Listing updated successfully!');

            redirect('/workopia/listings/' . $id);
        }
    }

    /**
     * Method search for listings by keywords/location 
     *
     * @return void
     */
    public function search(): void
    {
        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';

        $query = "SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR company LIKE :keywords OR tags LIKE :keywords OR company Like :keywords) AND (city LIKE :location OR state LIKE :location)";

        $params = [
            'keywords' => '%' . $keywords . '%',
            'location' => '%' . $location . '%',
        ];

        $listings = $this->db->query($query, $params)->fetchAll();

        load_view(
            'listings/index',
            [
                'listings' => $listings,
                'keywords' => $keywords,
                'location' => $location
            ]
        );
    }
}
