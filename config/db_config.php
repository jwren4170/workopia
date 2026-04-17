<?php

// Database configuration
$host = 'localhost';
$port = 5432;
$dbName = 'workopia';
$user = 'jword';
$password = 'intune67';

define('TITLE', 'BLog');

function connect(string $host, int $port, string $dbName, string $user, string $password)
{
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";

        $attr_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ
        ];

        $pdo = new PDO($dsn, $user, $password, $attr_options);

        return $pdo;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
return connect($host, $port, $dbName, $user, $password);
