<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../models/City.php';

    $database = new Database();
    $db = $database->getConnection();

    $city = new City($db);

    if (!empty($data['name'])) {

        if ($city->create($data)) {
            http_response_code(201);
            echo json_encode(array("message" => "City added!"));
        }
        else {
            http_response_code(503);
            echo json_encode(array("message" => "Cannot add city!"));
        }
    }
    else {
        http_response_code(400);
        echo json_encode(array("message" => "Cannot add city. Incomplete data!"));
    }

?>