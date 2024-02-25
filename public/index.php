<?php

require_once '../helpers.php';
require_once base_path('Database.php');
$config = require_once base_path('config/db.php');

$db = new Database($config);

require_once base_path('Router.php');

$router = new Router();

$routes = require_once base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);