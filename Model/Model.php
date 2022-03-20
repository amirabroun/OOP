<?php

namespace Models;

use DataBase\DataBase;
use Config\Config;
use PDO;

class Model extends DataBase
{
    private $sql;
    
    public static function prepareSQL($sql)
    {
        return (new DataBase)->cn->prepare($sql);
    }
}
