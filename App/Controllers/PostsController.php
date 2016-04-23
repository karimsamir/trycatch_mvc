<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use Core\BaseController;
use Core\View;
use App\Models\Post;

/**
 * Description of PostController
 *
 * @author karim
 */
class PostsController extends BaseController {

    //put your code here

    public function indexAction() {
//        echo 'Hello world from index action';
//        var_dump($_GET);
        
        $posts = Post::getAll();
        View::renderTemplate("posts/index.html", ["posts" => $posts]);
    }

        public function createAction() {
        echo 'Hello world from create action';
    }
    
    public function editAction() {
        echo '<br>Hello world from edit action<br>';
        var_dump($this->route_params);
    }
}
