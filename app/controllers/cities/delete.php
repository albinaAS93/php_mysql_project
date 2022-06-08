<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once 'core/bootstrap.php';

    $request = new Request;
    $request->decodeHttpRequest();
    $data = $request->getBody();

    $database = new Database();
    $database->getConnection($config);

    $city = new City($database);

    if (!empty($data['id'])) {
        if ($city->delete($data)) {
            http_response_code(200);
            echo json_encode(array("message" => "City has been deleted."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "City was not deleted."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Error: Data is missing."));
    }

?>