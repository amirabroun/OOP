<?php

namespace Models;

use PDO;

class Category extends Model
{
    function getCategoryParents()
    {
        $sql = "SELECT * From categories where parent_id IS NULL  and status = 'active'";
        
        $result = parent::$cn->prepare($sql);
        $result->execute();
        
        if (!$result->rowCount() > 0) {
            return false;
        }
        
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    function createCategory($parent_id, $title, $description)
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $parent_id = (!(int)$parent_id) ? null : (int)$parent_id;
        $slug = sluggable($title);

        $sql = "insert into categories (parent_id, title, slug, description) values (?,?,?,?);";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $parent_id);
        $result->bindValue(2, $title);
        $result->bindValue(3, $slug);
        $result->bindValue(4, $description);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }

    function getCategories()
    {
        $sql = "SELECT * From categories";
        
        $result = parent::$cn->prepare($sql);
        $result->execute();
        
        if (!$result->rowCount() > 0) {
            return false;
        }
        
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    function updateCategory($id, $parent_id, $title, $description): bool
    {
        $title = sanitise($title);
        $description = sanitise($description);
        $parent_id = (!(int)$parent_id) ? null : (int)$parent_id;
        $id = (int)$id;
        $slug = sluggable($title);

        $sql = "update categories set title = ?, description = ?, slug = ?, parent_id = ? where id = ?;";

        $result = parent::$cn->prepare($sql);
        $result->bindValue(1, $title);
        $result->bindValue(2, $description);
        $result->bindValue(3, $slug);
        $result->bindValue(4, $parent_id);
        $result->bindValue(5, $id);

        if (!$result->execute()) {
            return false;
        }

        return true;
    }
}
