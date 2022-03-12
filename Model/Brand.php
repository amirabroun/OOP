<?php

namespace Models;

use PDO;
use Models\Admin;

class Brand extends Model
{
    public function getBrands()
    {
        $sql = "SELECT * From brands";

        $result = parent::$cn->prepare($sql);
        $result->execute();

        if (!$result->rowCount() > 0) {
            return false;
        }

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    function createBrand($title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);

        $sql = "insert into brands(title, description) values (?,?)";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $title);
        $result->bindValue(2, $description);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }

    function updateBrand($id, $title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $id = (int)$id;

        $sql = "update brands set title=?, description=? where id=$id";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $title);
        $result->bindValue(2, $description);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }
}
