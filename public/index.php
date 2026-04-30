<?php

use Framework\Router;

require __DIR__ . '/../vendor/autoload.php';
require '../vendor/fakerphp/faker/src/autoload.php';
require '../helpers.php';


$config = require base_path('config/config.php');

$router = new Router();
$routes = require base_path('routes.php');
$router->route($uri);
