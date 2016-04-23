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
    
    /**
     * render main view file
     * @param string $view
     * @param array $args
     */
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
    
    
    public static function renderTemplate($template, $args = []) {
        static $twig = null;
        
        if ($twig === NULL) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
        }
        
        echo $twig->render($template, $args);
    }
}
