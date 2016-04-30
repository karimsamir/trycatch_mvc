<?php

namespace App\Controllers;

use Core\BaseController;
use Core\View;
use App\Models\Contact;

/**
 * Description of ContactsController
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

    public function ajaxGetAllContactsAction() {

        if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
            $contact_obj = new Contact();
            // get all contacts
            $contacts = $contact_obj->getAll();

            echo json_encode($contacts);
        } 
        else {
            // redirect to show all contacts if not ajax
           $this->show404();
            return;
        }
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
        $contact = $contact_obj->findById($id);

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
     */
    public function editAction() {


        $id = $this->route_params["id"];

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
     * This is the action to update contacts
     * it should only run through post
     */
    public function updateAction() {

        if (empty($_POST)) {
            $this->show404();
            return;
        }

        $id = $_POST["id"];
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

        if (empty($_POST) || $this->validateToken() === false) {
            $this->show404();
            return;
        }

        $contactDetails = $this->validateInput();

        $contact_obj = new Contact();
        $result = $contact_obj->addNewContact($contactDetails);

        // show message depends on result from DB
        if ($result == true) {
            $_SESSION["success_message"] = "Contact added successfully";
        } else {
            $_SESSION["error_message"] = "Failed to add Contact";
        }

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
        } else {
            $contact_obj->deleteById($id);

            $_SESSION["success_message"] = "Contact deleted successfully";
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
