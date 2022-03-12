<?php

namespace Models;

use PDO;

class User extends Model
{
    function getUsers()
    {
        $sql = "SELECT * From users";

        $result = parent::$cn->prepare($sql);
        $result->execute();

        if (!$result->rowCount() > 0) {
            return false;
        }
        
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}
