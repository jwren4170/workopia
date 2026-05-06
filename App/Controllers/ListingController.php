<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected Database $db;

    public function __construct()
    {
        $config = require base_path('config/config.php');
        $this->db = new Database($config['db']);
    }

    /*
   * Show all listings
   *
   * @return void
   */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

        load_view('listings/index', [
            'listings' => $listings
        ]);
    }

    public function create()
    {
        load_view('listings/create');
    }

    public function show(array $params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        load_view('listings/show', ['listing' => $listing]);
    }

    public function store()
    {
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

        // Filter the POST data to include only allowed fields
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        // Add user_id to the data
        $newListingData['user_id'] = 1; // Hardcoded user id for now

        // Sanitize the data
        $newListingData = array_map('sanitize', $newListingData);

        // Validate required fields
        $requiredFields = ['title', 'description', 'email', 'city', 'state'];

        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            load_view('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData,
            ]);
            exit;
        } else {
            $fields = [];

            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
            }

            $fields = implode(', ', $fields);

            $values = [];

            foreach ($newListingData as $field => $value) {
                // Convert empty strings to null
                if ($value === '') {
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values = implode(', ', $values);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

            // inspect_and_die($query);

            $this->db->query($query, $newListingData);

            $_SESSION['success_message'] = 'Listing created successfully';

            redirect('/workopia/listings');
        }
    }

    public function edit(array $params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        load_view('listings/edit', [
            'listing' => $listing,
        ]);
    }

    public function update(array $params)
    {
        inspectAndDie($params);
    }

    public function destroy(array $params)
    {
        $id = $params['id'];
        $params = [
            'id' => $id,
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', $params);

        $_SESSION['success_message'] = 'Listing deleted successfully';

        redirect('/workopia/listings');
    }
}
