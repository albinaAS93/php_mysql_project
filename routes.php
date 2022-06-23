<?php

    return $routes = [

        'GET' => [
            'cities' => 'CitiesController@read',
            'flights' => 'FlightsController@read',
            'flights/cities' => 'FlightsController@filter',
            "flights/seats" => 'FlightsController@filter'
        ],
        'POST' => [
            'cities' => 'CitiesController@create',
            'flights' => 'FlightsController@create',
        ],
        'PUT' => [
            'cities' => 'CitiesController@update',
            'flights' => 'FlightsController@update',
        ],
        'DELETE' => [
            'cities' => 'CitiesController@delete',
            'flights' => 'FlightsController@delete',
        ]
    ];

?>