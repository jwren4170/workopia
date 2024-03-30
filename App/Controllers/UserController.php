<?php

namespace JWord\App\Controllers;

use JWord\Framework\Database;
use JWord\Framework\Validation;
use JWord\Framework\Session;

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

    /**
     * Store user in database
     *
     * @return void
     * 
     */
    public function store(): void
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        // Validation
        $errors = [];

        if (!Validation::string($name, 3, 30)) {
            $errors['name'] = 'Name must be between 3 and  30 characters';
        }

        if (!Validation::email($email)) {
            $errors['email'] = 'Please provide a valid email address';
        }

        if (!Validation::string($city, 3, 20)) {
            $errors['city'] = 'City must be between 3 and 20 characters';
        }

        if (!Validation::string($state, 2, 2)) {
            $errors['state'] = 'State must be exactly 2 characters';
        }

        if (!Validation::match($password, $password_confirmation)) {
            $errors['password'] = 'Passwords do not match';
        }

        if (!Validation::string($password, 6, 20)) {
            $errors['password'] = 'Password must be between 6 and 20 characters';
        }

        if (!empty($errors)) {
            load_view(
                'users/create',
                [
                    'errors' => $errors,
                    'user' => [
                        'name' => $name,
                        'email' => $email,
                        'city' => $city,
                        'state' => $state,
                        'password' => $password,
                        'password_confirmation' => $password_confirmation
                    ]
                ]
            );
            exit;
        }

        // check if email already exists
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'Email already exists';
            load_view(
                'users/create',
                [
                    'errors' => $errors,
                    'user' => [
                        'name' => $name,
                        'email' => $email,
                        'city' => $city,
                        'state' => $state
                    ]
                ]
            );
            exit;
        }

        // insert user
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);

        $user_id = $this->db->conn->lastInsertId();

        Session::set('user', [
            'id' => $user_id,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state
        ]);

        redirect('/workopia');
    }
}
