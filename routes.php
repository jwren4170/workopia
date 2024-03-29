<?php

// GET listing routes
$router->get('/workopia/', 'HomeController@index');
$router->get('/workopia/listings', 'ListingController@index');
$router->get('/workopia/listings/create', 'ListingController@create');
$router->get('/workopia/listings/edit/{id}', 'ListingController@edit');
$router->get('/workopia/listings/{id}', 'ListingController@show');

// POST listing routes
$router->post('/workopia/listings', 'ListingController@store');
$router->put('/workopia/listings/{id}', 'ListingController@update');
$router->delete('/workopia/listings/{id}', 'ListingController@destroy');

// GET user routes
$router->get('/workopia/auth/login', 'UserController@login');
$router->get('/workopia/auth/register', 'UserController@create');

// POST user routes
$router->post('/workopia/auth/register', 'UserController@store');
