<?php require __DIR__ . "/../vendor/autoload.php";

use App\Controllers\LoginController;
use App\Controllers\ProductController;
use App\Requests\LoginRequest;
use App\Requests\ProductRequest;
use App\Requests\Request;
use Router\Route;

if (checkAction("admin_login")) LoginController::adminLogin(new LoginRequest);
if (checkAction("update_product")) ProductController::updateProduct(new ProductRequest);
if (checkAction("create_product")) ProductController::createProduct(new ProductRequest);

if (checkAction("edit-brand")) {
    dd(new Request);
}

if (checkAction("log-out")) {
    if (isset($_SESSION['_admin_log_'])) {
        unset($_SESSION['_admin_log_']);

        redirect('/login/secret/' . md5(secretKey('secret_login')));
    }
}
