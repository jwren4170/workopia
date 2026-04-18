<?php

return [
    $router->get('/', 'controllers/home.php'),
    $router->get('/listings', 'controllers/listings/index.php'),
    $router->get('/listings/create', 'controllers/listings/create.php'),
    '404' => 'controllers/error/404.php'
];
