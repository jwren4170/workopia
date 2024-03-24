<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../helpers.php';

use JWord\Framework\Router;

$config = require_once base_path('config/db.php');

// Instantiate router
$router = new Router();

// Get routes
$routes = require_once base_path('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
