<?php

    require 'core/Router.php';
    require 'core/Request.php';
    require 'routes.php';


    $request = new Request;
    $request->decodeHttpRequest();
    /*echo "<pre>";
    var_dump($request);
    echo "</pre>";*/

    $router = new Router($routes);
    // $router->load($routes);
    $router->direct($request->getPath(), $request->getMethod());

?>