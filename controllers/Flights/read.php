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
    $stmt = $flight->read();
    $count = $stmt->rowCount();

    if ($count > 0) {
        $flight_arr = array();
        $flight_arr["Flights"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $flight_item = array(
                "Id" => $Id,
                "departure" => $departure,
                "arrival" => $arrival,
                "seats" => $seats
            );
            array_push($flight_arr["Flights"], $flight_item);
        }
        http_response_code(201);
        echo json_encode($stmt);
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "No city founded!"));
    }

?>