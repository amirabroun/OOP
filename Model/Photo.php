<?php

namespace Models;

class Photo extends Model
{
    public function createPhoto($name, $src)
    {
        $name = sanitise($name);
        $src = sanitise($src);

        $sql = "insert into photos (src, name) values (?,?);";
        $result = Model::prepareSQL($sql);

        $result->bindValue(1, $src);
        $result->bindValue(2, $name);

        if (!$result->execute()) {
            return false;
        }
        
        return parent::$cn->lastInsertId();
    }
}
