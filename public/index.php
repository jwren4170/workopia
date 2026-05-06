<?php

use Framework\Router;

session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/fakerphp/faker/src/autoload.php';
require __DIR__ . '/../helpers.php';

$config = require base_path('config/config.php');

$router = new Router();
$routes = require base_path('routes.php');

/** @var object $uri */
$router->route($uri);
