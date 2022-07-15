<?php

    include_once './app/controllers/CitiesController.php';
    include_once './app/controllers/FlightsController.php';

    class Router
    {
        protected $routes;

        function load($routes)
        {          

            $this->routes = $routes;

        }

        public function direct($uri, $request)
        {
            if (array_key_exists($uri, $this->routes[$request])) {
                return $this->action(
                    ...explode('@', $this->routes[$request][$uri])
                );

                
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "No route defined for this URI!"));
            }
        }

        protected function action($controller, $action)
        {

            $controller = new $controller;

            if (! method_exists($controller, $action)) {
                throw new Exception("{$controller} does not respond to action {$action} action.");
            }

            return $controller->$action();
            
        }

    }

?>