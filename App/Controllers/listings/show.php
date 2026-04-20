<?php

use Framework\Database;

$db_config = require base_path('config/config.php');
$db = new Database($db_config['db']);

$id = $_GET['id'];

$params = [
    'id' => $id,
];

$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

// inspect($listing);

load_view('listings/show', ['listing' => $listing]);
