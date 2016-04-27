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
class Contact extends BaseModel {

    public function getAll() {

        try {

            $db = static::getDB();

            $stmt = $db->query("select * from contacts");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function findById($id) {

        try {
            $result = false;

            $db = static::getDB();

            $statement = $db->prepare("select * from contacts where id = :id");
            $statement->execute(array(':id' => $id));
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function updateContact($contactDetails, $id) {

        try {
            $result = false;

            $db = static::getDB();


//           extract($contactDetails, EXTR_SKIP);
//           die(var_dump($name, $phone, $address));

            $statement = $db->prepare("UPDATE `contacts` "
                    . "SET name=:name, phone=:phone, address=:address "
                    . "where id=:id");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            $statement->bindParam(":id", $id);
            $result = $statement->execute();

//            $statement = $db->prepare("select * from contacts where id = :id");
//            $statement->execute(array(':id' => $id));
//            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function addNewContact($contactDetails) {

        try {
            $result = false;

            $db = static::getDB();


//           extract($contactDetails, EXTR_SKIP);
//           die(var_dump($name, $phone, $address));

            $statement = $db->prepare("INSERT INTO `contacts` "
                    . "(name, phone, address) "
                    . "VALUES (:name, :phone, :address)");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            $result = $statement->execute();

//            $statement = $db->prepare("select * from contacts where id = :id");
//            $statement->execute(array(':id' => $id));
//            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
