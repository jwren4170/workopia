<?php

require_once '../helpers.php';

$routes = [
    '/workopia/' => 'controllers/home.php',
    '/workopia/listings' => 'controllers/listings/index.php',
    '/workopia/listings/create' => 'controllers/listings/create.php',
    '404' => 'controllers/error/404.php'
];

$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
    require_once base_path($routes[$uri]);
} else {
    require_once base_path($routes['404']);
}