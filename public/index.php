<?php

//echo "Request URL = '" . $_SERVER["QUERY_STRING"] . "'";
//die(var_dump(__DIR__));
require_once __DIR__ . "/../Core/autoloader.php";

// $autoloader = new ClassAutoloader();
//spl_autoload_register(array($this, 'loadClass'));
use Core\Router;

$obj = new Router();
 
die(var_dump($_SERVER));



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

