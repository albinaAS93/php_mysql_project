<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'core/bootstrap.php';

    $request = new Request;
    $request->decodeHttpRequest();
    $data = $request->getBody();
    
    $database = new Database($config);
    $database->getConnection();
    
    $city = new City($database);
    
    if (!empty($data['name'])) {

        if ($city->create($data)) {

            http_response_code(201);
            echo json_encode(array("message" => "A new city has been added."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "City was not added."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error: Data is missing."));
    }

?>