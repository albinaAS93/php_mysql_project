<?php

    include_once 'core/Router.php';
    include_once 'core/Request.php';
    $routes = include_once 'routes.php';

    $request = new Request;
    $request->decodeHttpRequest();

    $fileContent = file(__DIR__.'/.env');
    foreach($fileContent as $envVar){
        putenv(trim($envVar));} 

    $router = new Router;
    $router->load($routes);

    $router->direct($request->getPath(), $request->getMethod());

?>