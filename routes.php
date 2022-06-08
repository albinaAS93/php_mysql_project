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

?>