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

    /**
     * get all contacts
     * @return array
     */
    public function getAll() {

        try {

            $stmt = $this->db->query("select * from contacts");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * find contact by its id
     * @param int $id
     * @return array contact array
     */
    public function findById($id) {

        try {
            $result = false;

            $statement = $this->db->prepare("select * from contacts where id = :id");
            $statement->execute(array(':id' => $id));
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * update contact details
     * @param array $contactDetails
     * @param int $id
     * @return int affected rows
     */
    public function updateContact($contactDetails, $id) {

        try {
            $result = false;

            $statement = $this->db->prepare("UPDATE `contacts` "
                    . "SET name=:name, phone=:phone, address=:address "
                    . "where id=:id");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            $statement->bindParam(":id", $id);
            $result = $statement->execute();

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * add new contact
     * @param array $contactDetails
     * @return int inserted id
     */
    public function addNewContact($contactDetails) {

        try {
            $result = false;

            $statement = $this->db->prepare("INSERT INTO `contacts` "
                    . "(name, phone, address) "
                    . "VALUES (:name, :phone, :address)");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            $result = $statement->execute();

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * delete contact by its id
     * @param int $id
     * @return int rows affected
     */
    public function deleteById($id) {

        try {
            $result = false;

            $statement = $this->db->prepare("DELETE FROM `contacts` where id=:id");
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();

            return $result;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
