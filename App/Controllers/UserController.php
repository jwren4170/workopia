<?php

namespace JWord\App\Controllers;

use JWord\Framework\Database;
use JWord\Framework\Validation;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require base_path('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * show login form
     *
     * @return void
     * 
     */
    public function login(): void
    {
        load_view('users/login');
    }

    /**
     * show register form
     *
     * @return void
     * 
     */
    public function create(): void
    {
        load_view('users/create');
    }
}
