<?php

namespace Models;

use DataBase\DataBase;
use Helper\Helper;
use PDO;

class Admin extends Model
{
    public static function doLogin($username, $password)
    {
        // dd(12112);

        $sql = "SELECT * From admins where username = ? LIMIT 1";

        $result = DataBase::$cn->prepare($sql);
        $result->bindValue(1, $username);
        dd(1);
        $result->execute();

        if (!$result->rowCount() > 0)
            return false;

        $admin = $result->fetch(PDO::FETCH_OBJ);
        if (bcrypt($password, $admin->password))
            return false;

        return $admin;
    }

    public static function getAdmin($id)
    {
        $sql = "SELECT * From admins where id = ? LIMIT 1";

        $result = DataBase::$cn->prepare($sql);
        dd($sql);
        $result->bindValue(1, $id);
        $result->execute();

        if (!$result->rowCount() > 0) {
            return false;
        }

        return $result->fetch(PDO::FETCH_OBJ);
    }
}
