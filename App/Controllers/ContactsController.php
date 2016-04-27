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
class ContactsController extends BaseController {

    /**
     * show all contacts
     */
    public function indexAction() {
        $contact_obj = new Contact();
        // get all contacts
        $contacts = $contact_obj->getAll();

        View::renderTemplate("contacts/index.twig.php", ["contacts" => $contacts]);
    }

    /**
     * show selected contact
     */
    public function showAction() {

        // validate id is int
        $id = $this->route_params["id"];

        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($this->route_params["id"]);

        if ($contact == false) {
            // redirect to show all contacts if contacts not found
            header("Location: /contacts");
        }
        View::renderTemplate("contacts/show.twig.php", ["contact" => $contact]);
    }

    /**
     * show an edit form for a selected contact
     */
    public function editAction() {

        // validate id is int
        $id = $this->route_params["id"];

        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($id);

        if ($contact == false) {
            // redirect to show all contacts if contacts not found
            $this->show404();
            return;
        }
        View::renderTemplate("contacts/edit.twig.php", ["contact" => $contact]);
    }

    /**
     * This is the action to update contacts
     * it should only run through post
     */
    public function updateAction() {

        if (empty($_POST)) {
            $this->show404();
            return;
        }
        $contactDetails = array();

        $id = $_POST["id"];
        $contactDetails["name"] = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $contactDetails["phone"] = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $contactDetails["address"] = filter_var($_POST["address"], FILTER_SANITIZE_STRING);

        // validate id is int
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            // redirect to show all contacts if contacts not found
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $result = $contact_obj->updateContact($contactDetails, $id);

        // redirect to show all contacts
        header("Location: /contacts");
    }

    /**
     * show an edit form for a selected contact
     */
    public function createAction() {

        View::renderTemplate("contacts/create.twig.php");
    }

    /**
     * This is the action to store  contacts
     * it should only run through post
     */
    public function storeAction() {

        if (empty($_POST)) {
            $this->show404();
            return;
        }
        $contactDetails = $this->validateInput();

        $contact_obj = new Contact();
        $result = $contact_obj->addNewContact($contactDetails);

        // redirect to show all contacts
        header("Location: /contacts");
    }

    /**
     * This is the action to store  contacts
     * it should only run through post
     */
    public function deleteAction() {

        // validate id is int
        $id = $this->route_params["id"];

        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($id);

        if ($contact == false) {
            // redirect to show all contacts if contacts not found
            $this->show404();
            return;
        }
        else{
            $contact_obj->deleteById($id);
            // redirect to show all contacts
            header("Location: /contacts");
        }
    }

    private function validateInput() {
        $contactDetails = array();

        $contactDetails["name"] = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $contactDetails["phone"] = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $contactDetails["address"] = filter_var($_POST["address"], FILTER_SANITIZE_STRING);

        return $contactDetails;
    }

}
