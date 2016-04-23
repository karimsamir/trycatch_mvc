<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Core\Model;
use PDO;


/**
 * Description of Post
 *
 * @author karim
 */
class Post extends Model{

    public static function getAll() {

        try {

            $db = static::getDB();

            $stmt = $db->query("select * from posts order by created_at");

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
