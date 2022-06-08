<?php

    return $routes = [
        'GET' => [
            'cities' => 'app/controllers/cities/read.php',
            'flights' => 'app/controllers/flights/read.php',
            'flights/cities' => 'app/controllers/flights/filter.php',
            "flights/seats" => 'app/controllers/flights/filter.php'
        ],
        'POST' => [
            'cities' => 'app/controllers/cities/create.php',
            'flights' => 'app/controllers/flights/create.php'
        ],
        'PUT' => [
            'cities' => 'app/controllers/cities/update.php',
            'flights' => 'app/controllers/flights/update.php'
        ],
        'DELETE' => [
            'cities' => 'app/controllers/cities/delete.php',
            'flights' => 'app/controllers/flights/delete.php'
        ]
    ];

    // $router->get('cities', 'app/controllers/cities/read.php');
    // $router->get('flights', 'app/controllers/flights/read.php');
    // $router->get('flights/cities', 'app/controllers/flights/filter.php');
    // $router->get('flights/cities', 'app/controllers/flights/filter.php');

    // $router->post('cities', 'app/controllers/cities/create.php');
    // $router->post('flights', 'app/controllers/cities/create.php');

    // $router->put('cities', 'app/controllers/cities/update.php');
    // $router->put('flights', 'app/controllers/cities/update.php');

    // $router->delete('cities', 'app/controllers/cities/delete.php');
    // $router->delete('flights', 'app/controllers/cities/delete.php');

?>