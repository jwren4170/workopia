<?php

require '../helpers.php';
require base_path('Router.php');


$basePath = str_replace('/public/index.php', '', $_SERVER['SCRIPT_NAME']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, strlen($basePath)) ?: '/';


$method = $_SERVER['REQUEST_METHOD'];

define('BASE_URL', $basePath . '/public');

$router = new Router();

$routes = require base_path('routes.php');


$router->route($uri, $method);
