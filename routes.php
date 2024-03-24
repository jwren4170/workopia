<?php

// GET routes
$router->get('/workopia/', 'HomeController@index');
$router->get('/workopia/listings', 'ListingController@index');
$router->get('/workopia/listings/create', 'ListingController@create');
$router->get('/workopia/listings/edit/{id}', 'ListingController@edit');
$router->get('/workopia/listings/{id}', 'ListingController@show');

// POST routes
$router->post('/workopia/listings', 'ListingController@store');
$router->put('/workopia/listings/{id}', 'ListingController@update');
$router->delete('/workopia/listings/{id}', 'ListingController@destroy');
