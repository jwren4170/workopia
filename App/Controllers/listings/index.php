<?php

use Framework\Database;

$db_config = require base_path('config/config.php');
$db = new Database($db_config['db']);

$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

// inspect($listings);

load_view('listings/index', ['listings' => $listings]);
