<?php require __DIR__ . "/vendor/autoload.php";

use Config\Config;
use Route\Router\Route;

Route::get('/test', '/Resource/test.php');
Route::get('/', '/Resource/index.php');

Route::get('/login/secret/' . md5(Config::SECRET_LOGIN), '/Resource/login.php');
