<?php

/**
 * Description of Router
 *
 * @author karim
 */

namespace Core;

use App\Controllers;

class Router {

    //put your code here
//    public function __construct() {
//        echo "<br> <h1>Router class loaded</h1> <br>";
//    }

    protected $routes = [];
    protected $params = [];

    public function add($route, $params = []) {
        $this->routes[$route] = $params;
//        // convert route to regular expression
//        $route = preg_replace('/\//', '\\/', $route);
//
//        //covert variables
//        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
//
//        //covert variables
//        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
//
//
//        //add start and end del
//        $route = '/^' . $route . "$/i";
////        die(var_dump($route));
//        $this->routes[$route] = $params;
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function match($url) {
var_dump($this->routes);
        
        foreach ($this->routes as $route => $params) {

            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
//        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

//        foreach ($this->routes as $route => $params) {
//            var_dump($route);
//            var_dump("*-*-*-**-*-*-*-*-*-*-*-*-*-");
//            if (preg_match($route, $url, $matches)) {
//                //get named captured value
////                $params = [];
//
//                foreach ($matches as $key => $match) {
//
//                    if (is_string($key)) {
//                        $params[$key] = $match;
//                    }
//                }
//
//                $this->params = $params;
//                return true;
//            }
//        }
        return false;
    }

    public function getParams() {
        return $this->params;
    }

    public function dispatch($url) {

//        if (class_exists("App\Controllers\Posts")) {
//            die("found");
//        }
//        $post_obj = new Controllers\Posts();
//        $post_obj->index();
        
        if ($this->match($url)) {
//            var_dump('check');
//            die(var_dump($this->params));
            $controller = $this->params["Controller"];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = "App\Controllers\\" .$controller;
//            var_dump("controller ==$controller:::::");
            if (class_exists($controller)) {
                $controller_object = new $controller();
//                die(var_dump(get_class_methods($controller_object)));
                $action = $this->params["action"];
                $action = $this->convertToCamelCase($action);

                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    echo "Method $action in controller $controller not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        }
        else{
            echo "Invalid URL: $url";
        }
    }

    /**
     * convert string with hyphens to studlycaps
     * @param String $string
     * @return String
     */
    protected function convertToStudlyCaps($string) {
        return str_replace(" ", "", ucwords(str_replace("-", " ", $string)));
    }

    /**
     * Convert string to camelcase
     * @param String $string
     * @return String
     */
    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

}
