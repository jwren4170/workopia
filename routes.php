<?php

return [
    $router->get('/', 'HomeController@index'),
    $router->get('/listings', 'ListingController@index'),
    $router->get('/listings/create', 'ListingController@create'),
    $router->get("/listings/{id}", 'ListingController@show'),

    '404' => 'controllers/error/404.php'
];
