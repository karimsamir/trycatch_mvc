<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use Core\BaseController;
use Core\View;

/**
 * Description of PostController
 *
 * @author karim
 */
class HomeController extends BaseController{

    //put your code here

    public function indexAction() {
//        View::render("home/index.php", [
//            "name" => "Karim",
//            "colours" => ["red", "green", "blue"]
//        ]); 
//        echo 'Hello world from Home controller and index action';
        
        View::renderTemplate("home/index.html", [
            "name" => "Karim",
            "colours" => ["red", "green", "blue"]
        ]);
    }
}
