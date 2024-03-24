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

        redirect('/workopia/listings');
    }
}
