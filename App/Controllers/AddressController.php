<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * index (collection), create, store, show, edit, update, delete
 */

namespace App\Controllers;

use Core\BaseController;
use Core\View;
use App\Models\Contact;

/**
 * Description of AddressController
 *
 * @author karim
 */
class AddressController extends BaseController {

    public function index() {
        $contact_obj = new Contact();
        $contacts = $contact_obj->getAll();

        View::renderTemplate("address/index.twig.php", ["contacts" => $contacts]);
    }

    public function show() {

        // validate id is int
        $id = htmlspecialchars($this->route_params["id"]);

        if (!is_numeric($id)) {
            header("HTTP/1.0 404 Not Found");
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($this->route_params["id"]);

        if ($contact == false) {
            // redorect to show all contacts if contacts not found
            header("Location: /address");
        }
        View::renderTemplate("address/show.twig.php", ["contact" => $contact]);
    }
    
    public function edit() {

//        var_dump($this->route_params);
        // validate id is int
        $id = htmlspecialchars($this->route_params["id"]);

        if (!is_numeric($id)) {
            header("HTTP/1.0 404 Not Found");
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($this->route_params["id"]);

        if ($contact == false) {
            // redorect to show all contacts if contacts not found
            header("Location: /address");
        }
        View::renderTemplate("address/edit.twig.php", ["contact" => $contact]);
    }

}
