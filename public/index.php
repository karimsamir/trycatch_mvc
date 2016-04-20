<?php

//echo "Request URL = '" . $_SERVER["QUERY_STRING"] . "'";
//die(var_dump(__DIR__));
require_once __DIR__ . "/../Core/autoloader.php";

// $autoloader = new ClassAutoloader();
//spl_autoload_register(array($this, 'loadClass'));
use Core\Router;

$router = new Router();


// Add some routes
$router->add("", [
    "Controller" => "Home",
    "action" => "index"
        ]
);

$router->add("posts", [
    "Controller" => "Posts",
    "action" => "index"
        ]
);

$router->add("posts/new", [
    "Controller" => "Posts",
    "action" => "new"
        ]
);

$url = $_SERVER["QUERY_STRING"];

echo "<br>************************************************<br>";

if($router->match($url)) {
    var_dump($router->getParams());
}
else{
    echo "<br>No route found for URL: $url<br>";
}
echo "<br>************************************************<br>";
var_dump($router->getRoutes());

var_dump($_SERVER);




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

