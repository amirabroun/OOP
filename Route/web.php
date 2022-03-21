<?php require __DIR__ . "/../vendor/autoload.php";

use Controller\LoginController;

if (checkAction("admin_login")) {
    LoginController::adminLogin(POST("username"), POST("password"));
}
