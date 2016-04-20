<?php
/**
 * Description of Router
 *
 * @author karim
 */

namespace Core;

class Router {

    //put your code here
//    public function __construct() {
//        echo "<br> <h1>Router class loaded</h1> <br>";
//    }

    protected $routes = [];

    public function add($route, $params) {
        $this->routes[$route] = $params;
    }
    
    public function getRoutes() {
        return $this->routes;
    }

}
