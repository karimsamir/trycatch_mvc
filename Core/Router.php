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
    protected $params = [];

    public function add($route, $params = []) {
//        $this->routes[$route] = $params;
        // convert route to regular expression
        $route = preg_replace("/\//", "\\/", $route);

        //covert variables
        $route = preg_replace("/\{([a-z]+)}/", "(?P<\1>[a-z-]+)", $route);

        //add start and end del
        $route = '/^' . $route . "$/i";

        $this->routes[$route] = $params;
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function match($url) {

//        foreach ($this->routes as $route => $params) {
//
//            if ($url == $route) {
//                $this->params = $params;
//                return true;
//            }
//        }
//        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach ($this->routes as $route => $params) {
            
            if (preg_match($route, $url, $matches)) {
                //get named captured value
//                $params = [];

                foreach ($matches as $key => $match) {

                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams() {
        return $this->params;
    }

}
