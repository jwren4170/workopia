<?php

$router->get('/workopia/', 'HomeController@index');
$router->get('/workopia/listings', 'ListingController@index');
$router->get('/workopia/listings/create', 'ListingController@create');
$router->get('/workopia/listing/{id}', 'ListingController@show');