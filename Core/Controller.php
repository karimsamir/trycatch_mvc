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
abstract class Controller {
    
    // route params
    protected $route_params = [];
    
    public function __construct($route_params) {
        $this->route_params = $route_params;
    }
}
