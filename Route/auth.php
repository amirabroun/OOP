<?php require __DIR__ . "/../vendor/autoload.php";

use App\Config\Config;

if (empty($_SESSION))
    session_start();

if (empty($_SESSION["_admin_log_"])) {
    if (!(in_array(pageName(), Config::IGNORE_AUTH_PAGE) || (in_array(uri(), Config::IGNORE_AUTH_PAGE))))
        fail();
}

if (uri() === ('login/secret/' . md5(Config::SECRET_LOGIN)) && isset($_SESSION["_admin_log_"]))
    redirect('/');
