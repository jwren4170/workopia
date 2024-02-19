<?php

$routes = require_once base_path('routes.php');

if (array_key_exists($uri, $routes)) {
    require_once base_path($routes[$uri]);
} else {
    http_response_code(404);
    require_once base_path($routes['404']);
}