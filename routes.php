<?php

return [
    $router->get('/', 'HomeController@index'),
    $router->get('/listings', 'ListingController@index'),
    $router->get('/listings/create', 'ListingController@create'),
    $router->get("/listings/{id}", 'ListingController@show'),
    $router->get('/listings/edit/{id}', 'ListingController@edit'),

    $router->post('/listings', 'ListingController@store'),
    $router->put('/listings/{id}', 'ListingController@update'),
    $router->delete('/listings/delete/{id}', 'ListingController@destroy'),



    '404' => 'controllers/error/404.php'
];
