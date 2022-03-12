<?php

namespace Models;

use Config\Config;
use DataBase\DataBase;
use Functions\HelperFunction;
use Functions\HelperRequest;
use Functions\HelperValidator;
use PDO;

class Model extends DataBase
{
    use PDO, HelperRequest, HelperFunction, HelperValidator;
    private $connect;

    private function __construct()
    {
        parent::$cn = parent::$cn;
    }
}
