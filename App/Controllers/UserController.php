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
            'id' => null,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (id, name, email, city, state, password) VALUES (:id, :name, :email, :city, :state, :password)', $params);

        $id = $this->db->conn->lastInsertId();

        Session::set('user', [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state
        ]);

        redirect('/workopia');
    }

    /**
     * Logout user
     *
     * @return void
     * 
     */
    public function logout(): void
    {
        $params = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        Session::clear('user');
        Session::destroy();

        redirect('/workopia');
    }

    /**
     * Authenticate user based on email and password
     *
     * @return void
     * 
     */
    public function authenticate(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please provide a valid email address';
        }

        if (!Validation::string($password, 6, 20)) {
            $errors['password'] = 'Password must be between 6 and 20 characters';
        }

        if (!empty($errors)) {
            load_view(
                'users/login',
                [
                    'errors' => $errors
                ]
            );
            exit;
        }

        // check if email already exists
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if (!$user) {
            $errors['email'] = 'Either email or password is incorrect';
            load_view(
                'users/login',
                [
                    'errors' => $errors
                ]
            );
            exit;
        }

        // check password
        if (!password_verify($password, $user->password)) {
            $errors['password'] = 'Either email or password is incorrect';
            load_view(
                'users/login',
                [
                    'errors' => $errors
                ]
            );
            exit;
        }

        Session::set('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'city' => $user->city,
            'state' => $user->state
        ]);

        redirect('/workopia');
    }
}
