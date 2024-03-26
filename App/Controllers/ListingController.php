<?php

namespace JWord\App\Controllers;

use JWord\Framework\Database;
use JWord\Framework\Validation;

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
        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();

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

        $new_listing_data['user_id'] = 2;

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

        $listing = $this->db->query('DELETE FROM listings WHERE id = :id', ['id' => $id]);
        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
        }

        $_SESSION['success_message'] = 'Listing deleted successfully';

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

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
        if (!$listing) {
            ErrorController::not_found('Listing not found');
            return;
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

            $_SESSION['success_message'] = 'Listing updated successfully';

            redirect('/workopia/listings/' . $id);
        }
    }
}
