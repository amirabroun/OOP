<?php require __DIR__ . "/../vendor/autoload.php";

use Config\Config;
use Controllers\LoginController;
use Requests\LoginRequest;

if (checkAction("admin_login")) {
    (new LoginController)->adminLogin(new LoginRequest);
}

if (checkAction("log-out")) {
    if (isset($_SESSION['_admin_log_'])) {
        unset($_SESSION['_admin_log_']);

        redirect('login.php?secret=' . md5(Config::SECRET_LOGIN));
    }
}
