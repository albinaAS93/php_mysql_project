<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../models/City.php';

    $database = new Database();
    $db = $database->getConnection();

    $city = new City($db);
    $stmt = $city->read();
    $count = $stmt->rowCount();

    if($count > 0) {
        $city_arr = array();
        $city_arr["Cities"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $city_item = array(
                "Id" => $Id,
                "Name" => $Name
            );
            array_push($city_arr["Cities"], $city_item);
        }
        http_response_code(200);
        echo json_encode($city_arr);
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "No city founded!"));
    }

?>