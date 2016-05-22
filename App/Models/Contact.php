<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Contact class  represent contact table 
 *
 * @author karim
 */
class Contact extends Model {

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

            $this->error_log("Error", $exc->getTraceAsString());
        }
    }

    /**
     * find contact by its id
     * @param int $id
     * @return array contact array
     */
    public function findById($id) {

        $result = false;

        try {

            $statement = $this->db->prepare("select * from contacts where id = :id");
            $statement->execute(array(':id' => $id));
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $exc) {
            $this->error_log("Error", $exc->getTraceAsString());
        }
        return $result;
    }

    /**
     * update contact details
     * @param array $contactDetails
     * @param int $id
     * @return int affected rows
     */
    public function updateContact($contactDetails, $id) {

        $result = false;

        try {

            $statement = $this->db->prepare("UPDATE `contacts` "
                    . "SET name=:name, phone=:phone, address=:address "
                    . "where id=:id");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            $statement->bindParam(":id", $id);

            $result = $statement->execute();
            
        } catch (\PDOException $exc) {
            $this->error_log("Error", $exc->getTraceAsString());
        }

        return $result;
    }

    /**
     * add new contact
     * @param array $contactDetails
     * @return int inserted id
     */
    public function addNewContact($contactDetails) {

        $result = false;

        try {

            $statement = $this->db->prepare("INSERT INTO `contacts` "
                    . "(name, phone, address) "
                    . "VALUES (:name, :phone, :address)");
            $statement->bindParam(":name", $contactDetails["name"]);
            $statement->bindParam(":phone", $contactDetails["phone"]);
            $statement->bindParam(":address", $contactDetails["address"]);
            
            $result = $statement->execute();
            
        } catch (\PDOException $exc) {
            $this->error_log("Error", $exc->getTraceAsString());
        }
        return $result;
    }

    /**
     * delete contact by its id
     * @param int $id
     * @return int rows affected
     */
    public function deleteById($id) {

        $result = false;

        try {

            $statement = $this->db->prepare("DELETE FROM `contacts` where id=:id");
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $statement->execute();

        } catch (\PDOException $exc) {
            $this->error_log("Error", $exc->getTraceAsString());
        }

        return $result;
    }

}
