<?php

use JWord\Framework\Middleware\Authorize;

// GET listing routes
$router->get('/workopia/', 'HomeController@index');
$router->get('/workopia/listings', 'ListingController@index');
$router->get('/workopia/listings/create', 'ListingController@create', ['auth']);
$router->get('/workopia/listings/edit/{id}', 'ListingController@edit', ['auth']);
$router->get('/workopia/listings/{id}', 'ListingController@show');


// POST listing routes
$router->post('/workopia/listings', 'ListingController@store', ['auth']);
$router->put('/workopia/listings/{id}', 'ListingController@update', ['auth']);
$router->delete('/workopia/listings/{id}', 'ListingController@destroy', ['auth']);

// GET user routes
$router->get('/workopia/auth/login', 'UserController@login', ['guest']);
$router->get('/workopia/auth/register', 'UserController@create', ['guest']);

// POST user routes
$router->post('/workopia/auth/register', 'UserController@store', ['guest']);
$router->post('/workopia/auth/logout', 'UserController@logout', ['auth']);
$router->post('/workopia/auth/login', 'UserController@authenticate', ['guest']);
