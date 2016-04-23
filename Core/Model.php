<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

use PDO;
/**
 * Description of Model
 *
 * @author karim
 */
abstract class Model {
    
    protected static function getDB() {
        
        static $db = null;
        
        if ($db === null) {
            $host = "localhost";
            $dbname = "mvc";
            $username = "root";
            $password = "";
            
            try {
                $db = new PDO("mysql:host=$host;dbname=$dbname;charset:utf8", 
                        $username, $password);
                return $db;
            } catch (\PDOException $exc) {
                echo $exc->getMessage();
            }
                    
        }
    }
}
