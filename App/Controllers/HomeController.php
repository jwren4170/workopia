<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;


class HomeController
{

    protected $db;

    public function __construct()
    {

        $db_config = require base_path('config/config.php');
        $this->db = new Database($db_config['db']);
    }

    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();

        load_view('home', [
            'listings' => $listings
        ]);
    }
}
