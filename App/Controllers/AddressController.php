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
        $id = $this->filterInput($this->route_params["id"]);


        if (!is_numeric($id)) {
            header("HTTP/1.0 404 Not Found");
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($this->route_params["id"]);

        if ($contact == false) {
            // redirect to show all contacts if contacts not found
            header("Location: /address");
        }
        View::renderTemplate("address/show.twig.php", ["contact" => $contact]);
    }

    public function edit() {

        // validate id is int
        $id = $this->filterInput($this->route_params["id"]);

        if (!is_numeric($id)) {
            header("HTTP/1.0 404 Not Found");
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($this->route_params["id"]);

        if ($contact == false) {
            // redirect to show all contacts if contacts not found
            header("Location: /address");
        }
        View::renderTemplate("address/edit.twig.php", ["contact" => $contact]);
    }

    public function update() {

        $contactDetails  = array();

        $id = $_POST["id"];
        $contactDetails["name"] = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $contactDetails["phone"] = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $contactDetails["address"] = filter_var($_POST["address"], FILTER_SANITIZE_STRING);

        // validate id is int
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            // redirect to show all contacts if contacts not found
            header("Location: /address");
        }

        $contact_obj = new Contact();
        $result = $contact_obj->updateContact($contactDetails, $id);

        // redirect to show all contacts
        header("Location: /address");
    }

}
