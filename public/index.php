<?php
error_reporting(E_ALL);

define("APPLICATION_PATH", dirname(__DIR__));
// require twig autoloader
require_once APPLICATION_PATH . "/vendor/autoload.php";


//echo "Request URL = '" . $_SERVER["QUERY_STRING"] . "'";
//die(var_dump(__DIR__));
require_once APPLICATION_PATH . "/Core/autoloader.php";


// set error handler
set_error_handler("Core\Error::errorHandler");
set_exception_handler("Core\Error::exceptionHandler");


use Core\Router;

$router = new Router();


// Add some routes
$router->add("", [
    "Controller" => "HomeController",
    "action" => "index"
        ]
);
//
//$router->add("posts", [
//    "Controller" => "PostsController",
//    "action" => "index"
//        ]
//);
//
//$router->add("posts/create", [
//    "Controller" => "PostsController",
//    "action" => "create"
//        ]
//);
//
//$router->add("posts/{id:(\d+)}/edit", [
//    "Controller" => "PostsController",
//    "action" => "edit"
//        ]
//);

$router->add("address", [
    "Controller" => "AddressController",
    "action" => "index"
        ]
);

$router->add("address/{id:(\d+)}", [
    "Controller" => "AddressController",
    "action" => "show"
        ]
);

$router->add("address/{id:(\d+)}/edit", [
    "Controller" => "AddressController",
    "action" => "edit"
        ]
);


//$router->add("admin/{Controller}/{action}", ["namespace" => "admin"]);


//$router->add("{Controller}/{action}");
//$router->add("{Controller}/{id:\d+}/{action}");

$url = $_SERVER["QUERY_STRING"];


$router->dispatch($url);


//echo "<br>************************************************<br>";
//
//if($router->match($url)) {
//    var_dump($router->getParams());
//}
//else{
//    echo "<br>No route found for URL: $url<br>";
//}
//echo "<br>************************************************<br>";
//var_dump($router->getRoutes());
//
//var_dump($_SERVER);




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

