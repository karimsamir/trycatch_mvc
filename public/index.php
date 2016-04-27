<?php
error_reporting(E_ALL);

define("APPLICATION_PATH", dirname(__DIR__));
// require twig autoloader
require_once APPLICATION_PATH . "/vendor/autoload.php";


// require application loader
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

$router->add("contacts", [
    "Controller" => "ContactsController",
    "action" => "index"
        ]
);

$router->add("contacts/{id:(\d+)}", [
    "Controller" => "ContactsController",
    "action" => "show"
        ]
);

$router->add("contacts/{id:(\d+)}/edit", [
    "Controller" => "ContactsController",
    "action" => "edit"
        ]
);

$router->add("contacts/update", [
    "Controller" => "ContactsController",
    "action" => "update"
        ]
);


//$router->add("admin/{Controller}/{action}", ["namespace" => "admin"]);


//$router->add("{Controller}/{action}");
//$router->add("{Controller}/{id:\d+}/{action}");

$url = $_SERVER["QUERY_STRING"];

session_start();

// get to controller function
$router->dispatch($url);
