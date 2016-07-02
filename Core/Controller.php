<?php

namespace Core;

use App\Config;

/**
 * Base Controller
 *
 * @author karim
 */
abstract class Controller {

    // route params 
    protected $route_params = [];
    // session
    protected $_token = "";

    /**
     * constructor to fill the route parameters
     * @param type $route_params
     */
    public function __construct($route_params) {
        $this->route_params = $route_params;
        //generate token to be used in forms
        $this->_token = $this->generateToken();
    }

    /**
     * used to call some functions  before and after actions in controllers
     * @param string $name function name of action
     * @param array $arguments to be used by action
     * @throws \Exception if method not found
     */
    public function __call($name, $arguments) {

        $method = $name . "Action";

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
//            echo "Method $method not found in controller " . get_class($this);
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * run function filter before any action
     */
    protected function before() {
        
    }

    /**
     * run function filter after any action
     */
    protected function after() {
//        echo 'after';
    }

    protected function show404() {
        // redirect to show all contacts
        header("Location: /pagenotfound");
        return;
    }

    /**
     * generate token to be used in forms
     * @return string
     */
    protected function generateToken() {

        $token = "";

        if (empty($_SESSION['_token'])) {
            // generate a token from an unique value
            $token = md5(uniqid(md5(Config::APP_KEY), true));

            // Write the generated token to the session variable to check it against the hidden field when the form is sent
            $_SESSION['_token'] = $token;
        } else {
            $token = $_SESSION['_token'];
        }

        return $token;
    }

    /**
     * validate token to check it matches
     * @return boolean
     */
    protected function validateToken() {

        // check if a session is started and a token is transmitted, if not return an error
        if (!isset($_SESSION['_token'])) {
            return false;
        }

        // check if the form is sent with token in it
        if (!isset($_POST['_token'])) {
            return false;
        }

        // compare the tokens against each other if they are still the same
        if ($_SESSION['_token'] !== $_POST['_token']) {
            return false;
        }

        return true;
    }

}
