<?php

namespace App\Controllers;

use Core\BaseController;
use Core\View;
use App\Models\Contact;

/**
 * Contacts controller to be used in CRUD for 
 * table contacts
 *
 * @author karim
 */
class ContactsController extends BaseController {

    /**
     * show all contacts
     */
    public function indexAction() {

        View::renderTemplate("contacts/index.twig.php");
    }

    /**
     * ajax function used to get all contacts from DB
     * and return it as json
     * @return json
     */
    public function ajaxGetAllContactsAction() {
        // check if call is ajax
        if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
            $contact_obj = new Contact();
            // get all contacts
            $contacts = $contact_obj->getAll();

            echo json_encode($contacts);
        } else {
            // redirect to show all contacts if not ajax
            $this->show404();
            return;
        }
    }

    /**
     * show selected contact using contact id
     */
    public function showAction() {

        // validate id is int
        $id = $this->route_params["id"];
        // if id is invalid redirect to 404 page
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($id);
        // if no contact returned then display error message
        if ($contact == false) {
            //set error message
            $_SESSION["error_message"] = "Contact not found or deleted";
            // redirect to show all contacts if contacts not found
            header("Location: /contacts");
            return;
        }

        View::renderTemplate("contacts/show.twig.php", ["contact" => $contact]);
    }

    /**
     * show an edit form for a selected contact
     * using contact id
     */
    public function editAction() {

        $id = $this->route_params["id"];
        // if id is invalid redirect to 404 page
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            $this->show404();
            return;
        }

        $contact_obj = new Contact();
        $contact = $contact_obj->findById($id);

        if ($contact == false) {
            //set error message
            $_SESSION["error_message"] = "Contact not found or deleted";
            // redirect to show all contacts if contacts not found
            header("Location: /contacts");
            return;
        }
        
        View::renderTemplate("contacts/edit.twig.php", [
            "contact" => $contact
        ]);
    }

    /**
     * This is the action to update a contact
     * it should only run through post
     */
    public function updateAction() {
        // if the page has no post 
        // then redirect to 404
        if (empty($_POST)) {
            $this->show404();
            return;
        }

        $id = $_POST["id"];
        // validate other contacts data
        $contactDetails = $this->validateInput();

        // validate id is int
        if (filter_var($id, FILTER_VALIDATE_INT) === false ||
                $this->validateToken() === false) {
            //set error message
            $_SESSION["error_message"] = "Invalid Data supplied";
            // redirect to show all contacts
            header("Location: /contacts");
            return;
        }

        $contact_obj = new Contact();
        $result = $contact_obj->updateContact($contactDetails, $id);

        // show message depends on result from DB
        if ($result == true) {
            $_SESSION["success_message"] = "Contact updated successfully";
        } else {
            $_SESSION["error_message"] = "Failed to update Contact";
        }
        // redirect to show all contacts
        header("Location: /contacts");
    }

    /**
     * show an create form to add a new contact
     */
    public function createAction() {

        View::renderTemplate("contacts/create.twig.php");
    }

    /**
     * This is the action to store contacts
     * it should only run through post
     */
    public function storeAction() {
        // if the page has no post and token is invalid
        // then redirect to 404
        if (empty($_POST) || $this->validateToken() === false) {
            $this->show404();
            return;
        }
        // validate other contacts data
        $contactDetails = $this->validateInput();

        $contact_obj = new Contact();
        $result = $contact_obj->addNewContact($contactDetails);

        // show message depends on result from DB
        if ($result == true) {
            $_SESSION["success_message"] = "Contact added successfully";
        } else {
            $_SESSION["error_message"] = "Failed to add Contact";
        }

        // after saving the new contact
        // redirect to show all contacts
        header("Location: /contacts");
    }

    /**
     * This is the action to delete contacts
     */
    public function deleteAction() {

        // get id from Get
        $id = $this->route_params["id"];
        // validate id is int
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
        } else {
            $contact_obj->deleteById($id);

            $_SESSION["success_message"] = "Contact deleted successfully";
            // redirect to show all contacts
            header("Location: /contacts");
        }
    }

    /**
     * validate contacts details especially name, Phone and address
     * and convert special characters to html tags 
     * @return array
     */
    private function validateInput() {
        $contactDetails = array();

        $contactDetails["name"] = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $contactDetails["phone"] = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $contactDetails["address"] = filter_var($_POST["address"], FILTER_SANITIZE_STRING);

        return $contactDetails;
    }

}
