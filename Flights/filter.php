<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../models/Flight.php';
    include_once '../models/City.php';

    $database = new Database();
    $db = $database->getConnection();

    $flight = new Flight($db);

    if (array_key_exists('name', $data)) {
        $stmt = $flight->selectByCity($data);
    }
    else if (array_key_exists('seats', $data)) {
        $stmt = $flight->selectBySeats($data);
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "Error: Data is incomplete!"));
    }

    if ($stmt !== false) {
        http_response_code(201);
        echo json_encode($stmt);
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "No city founded!"));
    }


?>