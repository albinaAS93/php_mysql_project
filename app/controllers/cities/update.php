<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'core/bootstrap.php';

    $request = new Request;
    $request->decodeHttpRequest();
    $data = $request->getBody();

    $database = new Database();
    $database->getConnection($config);

    $city = new City($database);

    if (!empty($data['id']) && !empty($data['name'])) {

        if ($city->update($data)) {
            http_response_code(200);
            echo json_encode(array("message" => "City has been updated."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "City was not updated."));
        }

    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error: Data is missing."));
    }

?>