<?php require __DIR__ . "/../vendor/autoload.php";

use App\Controllers\LoginController;
use App\Requests\LoginRequest;
use Router\Route;

if (checkAction("admin_login")) {
    (new LoginController)->adminLogin(new LoginRequest);
}

if (checkAction("log-out")) {
    if (isset($_SESSION['_admin_log_'])) {
        unset($_SESSION['_admin_log_']);

        redirect('/login/secret/' . md5(secretKey('secret_login')));
    }
}
