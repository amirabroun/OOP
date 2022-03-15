<?php

namespace DataBase;

use Config\Config;
use Helper\Helper;
use PDOException;
use PDO;

class DataBase extends Config
{
    public $cn;

    public function __construct()
    {
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT");
        $database = getenv("DATABASE");
        $username = getenv('USERNAME');
        $password = getenv('PASSWORD');
        $charset = getenv('CHARSET');
        $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=$charset";

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->cn = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $error) {
            die("<h3>$error</h3>");
        }
    }
}
