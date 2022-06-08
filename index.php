<?php

    require 'core/Router.php';
    require 'core/Request.php';
    $routes = require 'routes.php';

    $request = new Request;
    $request->decodeHttpRequest();

    $router = new Router;
    $router->load($routes);
    $router->direct($request->getPath(), $request->getMethod());

?>