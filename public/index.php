<?php
require_once __DIR__ . '/../vendor/autoload.php';

use JWord\Framework\Router;
use JWord\Framework\Session;

Session::start();

require_once '../helpers.php';

$config = require_once base_path('config/db.php');

// Instantiate router
$router = new Router();

// Get routes
$routes = require_once base_path('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
