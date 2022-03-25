<?php require __DIR__ . "/vendor/autoload.php";

use Config\Config;

any('/test', '/Resource/test.php');
any('/', '/Resource/index.php');

any('/login/secret/' . md5(Config::SECRET_LOGIN), '/Resource/login.php');
