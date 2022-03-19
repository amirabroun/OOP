<?php

namespace Route;

require __DIR__ . "/../vendor/autoload.php";

use Controllers\LoginController;

if (POST("action") && POST("action") === "admin_login") {
    LoginController::adminLogin(POST("username"), POST("password"));
}
