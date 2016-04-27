<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

/**
 * Base Controller
 *
 * @author karim
 */
abstract class BaseController {

    // route params
    protected $route_params = [];

    public function __construct($route_params) {
        $this->route_params = $route_params;
    }

    public function __call($name, $arguments) {

        $method = $name . "Action";

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
//            echo "Method $method not found in controller " . get_class($this);
            throw new \Exception("Method $method not found in controller ". get_class($this));
        }
    }

    /**
     * run function filter before action
     */
    protected function before() {
//        echo 'before';
    }

    /**
     * run function filter after action
     */
    protected function after() {
//        echo 'after';
    }
    
    protected function show404() {
        View::renderTemplate("error/404.html");
    }

}
