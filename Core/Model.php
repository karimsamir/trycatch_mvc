<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Main Model class
 *
 * @author karim
 */
abstract class Model {
    // main connection
    public $db;

    public function __construct() {
        $this->db = static::getDB();
    }

    /**
     * Get DB connection string
     * @staticvar $db
     * @return Object PDO
     */
    protected static function getDB() {

        static $db = null;

        if ($db === null) {

            $db = new PDO("mysql:host=" . Config::DB_HOST
                    . ";dbname=" . Config::DB_NAME
                    . ";charset:utf8", Config::DB_USER, Config::DB_PASSWORD);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
    }

    /**
     * add to log log message with severity
     * @param String $severity
     * @param String $message
     */
    protected function error_log($severity, $message) {

        $msg = "$severity: $message";

        if (\App\Config::SHOW_ERRORS) {
            $_SESSION["error_message"] =  $msg;
        } else {
            $log = dirname(__DIR__) . "/logs/Database_" . date("Y-m-d") . ".txt";
            ini_set("error_log", $log);
            error_log($msg);
        }
    }

}
