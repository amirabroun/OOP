<?php require __DIR__ . "/vendor/autoload.php";

use App\Config\Config;
use Route\Router\Route;

Route::get('/test', '/Resource/test.php');
Route::get('/', '/Resource/index.php');

Route::get('/login/secret/' . md5(Config::SECRET_LOGIN), '/Resource/login.php');

Route::get('/products' , '/Resource/products.php');
Route::get('/brands' , '/Resource/brands.php');
Route::get('/categories' , '/Resource/categories.php');
Route::get('/users' , '/Resource/users.php');