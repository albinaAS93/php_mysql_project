<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../models/Flight.php';

    $database = new Database();
    $db = $database->getConnection();

    $flight = new Flight($db);

    if (!empty($data['departure']) && !empty($data['arrival']) && !empty($data['availableSeats'])) {

        if ($flight->create($data)) {
            http_response_code(201);
            echo json_encode(array("message" => "Flight added successfully!"));
        }
        else {
            http_response_code(503);
            echo json_encode(array("message" => "Flight cannot be added!"));
        }
    }
    else {
        http_response_code(400);
        echo json_encode(array("message" => "Error: Data is incomplete!"));
    }

?>