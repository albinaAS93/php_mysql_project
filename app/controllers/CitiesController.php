<?php

    include_once 'core/bootstrap.php';

    class CitiesController{


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

            $city = new City($database);

            $recordset = $city->selectAll();

            if ($recordset !== false) {
                http_response_code(201);
                echo json_encode($recordset);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "No city founded."));
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

        }
        
    }

?>