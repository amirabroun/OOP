<?php require __DIR__ . "/../vendor/autoload.php";

use Config\Config;
use Controller\LoginController;

if (checkAction("admin_login")) {
    LoginController::adminLogin(POST("username"), POST("password"));
}

if (checkAction("log-out")) {
    if (isset($_SESSION['_admin_log_'])) {
        unset($_SESSION['_admin_log_']);

        redirect('login.php?secret=' . md5(Config::SECRET_LOGIN));
    }
}
