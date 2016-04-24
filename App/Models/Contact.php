<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Core\BaseModel;
use PDO;


/**
 * Description of Post
 *
 * @author karim
 */
class Contact extends BaseModel{

    public static function getAll() {

        try {

            $db = static::getDB();

            $stmt = $db->query("select * from contacts");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
