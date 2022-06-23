<?php

    include_once 'core/bootstrap.php'; 

    class FlightsController{

        public function read() {

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            
            $request = new Request;
            $request->decodeHttpRequest();
            
            $database = new Database();
            $database->openConnection();
            
            $flight = new Flight($database);
            
            $recordset = $flight->selectAll();
            
            if ($recordset !== false) {
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "No flights founded."));
            }
        }

        public function create() {

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            
            $request = new Request;
            $request->decodeHttpRequest();
            $data = $request->getBody();
            
            $database = new Database();
            $database->openConnection();
            
            $flight = new Flight($database);
            
            if (
                !empty($data['departure']) &&
                !empty($data['arrival']) &&
                !empty($data['availableSeats'])
            ) {
                if ($flight->create($data)) {
                    http_response_code(201);
                    echo json_encode(array("message" => "A new flight has been added"));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Flight was not added."));
                }
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Error: Data is missing."));
            }

        }

        public function delete() {

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: DELETE");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            
            $request = new Request;
            $request->decodeHttpRequest();
            $data = $request->getBody();
            
            $database = new Database();
            $database->openConnection();
            
            $flight = new Flight($database);
            
            if (!empty($data['id'])) {
                if ($flight->delete($data)) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Flight has been deleted."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Flight was not deleted."));
                }
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Error: Data is missing."));
            }

        }

        public function update() {

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: PUT");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            
            $request = new Request;
            $request->decodeHttpRequest();
            $data = $request->getBody();
            
            $database = new Database();
            $database->openConnection();
            
            $flight = new Flight($database);
            
            if (
                !empty($data['id']) &&
                !empty($data['availableSeats'])
            ) {
                if ($flight->update($data)) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Flight has been updated."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Flight was not updated."));
                }
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Error: Data is missing."));
            }

        }

        public function filter() {

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            $request = new Request;
            $request->decodeHttpRequest();

            $database = new Database();
            $database->openConnection();

            $flight = new Flight($database);

            $data = $request->getBody();

            if (array_key_exists('name', $data)) {
                $recordset = $flight->selectByCity($data);
            } else if (array_key_exists('availableSeats', $data)) {
                $recordset = $flight->selectBySeats($data);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Error: Data is missing."));
            }

            var_dump($recordset);

            if ($recordset !== false) {
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "No city founded."));
            }
        }
        
    }

?>