<?php

namespace JWord\App\Controllers;

use JWord\Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require base_path('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Load home page
     *
     * @return void
     * 
     */
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

        load_view('home', ['listings' => $listings]);
    }
}
