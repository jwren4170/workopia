<?php
require '../helpers.php';

$basePath = str_replace('/public/index.php', '', $_SERVER['SCRIPT_NAME']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, strlen($basePath)) ?: '/';

$routes = [
    '/' => 'controllers/home.php',
    '/listings' => 'controllers/listings/index.php',
    '/listings/create' => 'controllers/listings/create.php',
    '404' => 'controllers/error/404.php' // Add this route
];

if (array_key_exists($uri, $routes)) {
    require base_path($routes[$uri]);
} else {
    require base_path($routes['404']);
}
