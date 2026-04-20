<?php

// Database configuration
$db_config = [
    'host' => 'localhost',
    'port' => 5432,
    'dbname' => 'workopia',
    'user' => 'jword',
    'password' => 'intune67'
];

// Application configuration
$basePath = str_replace('/public/index.php', '', $_SERVER['SCRIPT_NAME']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = substr($uri, strlen($basePath)) ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

// Constants
if (!defined('BASE_URL')) {
    define('BASE_URL', $basePath . '/public');
}
if (!defined('TITLE')) {
    define('TITLE', 'Workopia');
}

return [
    'db' => $db_config,
    'uri' => $uri,
    'method' => $method
];
