<?php

namespace Models;

use DataBase\DataBase;
use PDO;

class Admin extends Model
{
    public function doLogin($username, $password)
    {
        $sql = "SELECT * From admins where username = ? LIMIT 1";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $username);
        $result->execute();

        if (!$result->rowCount() > 0)
            return false;

        $admin = $result->fetch(PDO::FETCH_OBJ);
        if ($this->bcrypt($password, $admin->password))
            return false;

        return $admin;
    }

    function getAdmin($id)
    {
        $sql = "SELECT * From admins where id = ? LIMIT 1";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();

        if (!$result->rowCount() > 0) {
            return false;
        }

        return $result->fetch(PDO::FETCH_OBJ);
    }
}
