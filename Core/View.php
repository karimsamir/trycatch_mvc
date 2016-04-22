<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

/**
 * Class to be used to render a view file
 *
 * @author karim
 */
class View {
    
    public static function render($view, $args = []) {

        extract($args, EXTR_SKIP);
        
        // going up to views folder
        $file = "../App/Views/$view"; 

        if (file_exists($file)) {
            require $file;
        }
        else{
            echo "$file not found";
        }
    }
}
