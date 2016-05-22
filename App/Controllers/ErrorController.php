<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * ErrorController to show error pages
 *
 * @author karim
 */
class ErrorController extends Controller {

    /**
     * show 404 page
     */
    public function pagenotfoundAction() {

        View::renderTemplate("error/404.html");
    }

    /**
     * show 500 error
     */
    public function servererrorAction() {

        View::renderTemplate("error/500.html");
    }

}
