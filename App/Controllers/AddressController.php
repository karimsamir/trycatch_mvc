<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
class AddressController extends BaseController{
    
    public function index() {
        $contacts = Contact::getAll();
        View::renderTemplate("address/index.twig.php", ["contacts" => $contacts]);
    }
}
