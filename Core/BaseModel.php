<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

use PDO;
use App\Config;
/**
 * Description of Model
 *
 * @author karim
 */
abstract class BaseModel {
    
    protected static function getDB() {
        
        static $db = null;
        
        if ($db === null) {
//            $host = "localhost";
//            $dbname = "mvc";
//            $username = "root";
//            $password = "";
            
//            try {
//                $db = new PDO("mysql:host=" . Config::DB_HOST 
//                        .";dbname=" . Config::DB_NAME 
//                        .";charset:utf8", 
//                        Config::DB_USER, Config::DB_PASSWORD);
//                return $db;
//            } catch (\PDOException $exc) {
//                echo $exc->getMessage();
//            }

                $db = new PDO("mysql:host=" . Config::DB_HOST 
                        .";dbname=" . Config::DB_NAME 
                        .";charset:utf8", 
                        Config::DB_USER, Config::DB_PASSWORD);
                
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            
                    
        }
    }
}
