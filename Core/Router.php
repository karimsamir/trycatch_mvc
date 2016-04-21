<?php

/**
 * Description of Router
 *
 * @author karim
 */

namespace Core;

use App\Controllers;

/**
 * Class Router used to register routes and dispatching them
 */
class Router {

    protected $routes = [];
    protected $params = [];

    /**
     * Add routes to route table
     * @param string $route url 
     * @param array $params
     */
    public function add($route, $params = []) {
//        $this->routes[$route] = $params;
        // convert route to regular expression
        $route = preg_replace('/\//', '\\/', $route);

        //covert variables
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //covert variables
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);


        //add start and end del
        $route = '/^' . $route . "$/i";
//        die(var_dump($route));
        $this->routes[$route] = $params;
    }

    /**
     * get all routes
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * match a route to url 
     * check for route using url
     * @param type $url
     * @return boolean true if route is found 
     */
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
//            var_dump($route);
//            var_dump("*-*-*-**-*-*-*-*-*-*-*-*-*-");
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

    /**
     * get route params
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * execute route by loading controller and run required action
     * @param string $url
     */
    public function dispatch($url) {

        $url = $this->removeQueryStringVariables($url);
        
        if ($this->match($url)) {

            $controller = $this->params["Controller"];
            $controller = $this->convertToStudlyCaps($controller);
            // it should work without App\ as I have added a use statement
            // but for some reason it doesn't
            $controller = "App\Controllers\\" . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

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
        } else {
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
    /**
     * remove any  extra variables from the route
     * @param string $url
     * @return string $url
     */
    protected function removeQueryStringVariables($url) {
        
        if ($url != '') {
            $parts = explode("&", $url, 2);
            
            if (strpos($parts[0], "=") === false) {
                $url = $parts[0];
            }
            else{
                $url = '';
            }
        }
        return $url;
    }

}
