<?php

use App\Router\Router as Route;

Route::get('/test', '/resources/test.php');
Route::get('/', '/resources/index.php');

// login
Route::get('/login/secret/' . md5(secretKey('secret_login')), '/resources/login.php');

// product
Route::get('/products', '/resources/products.php');
Route::get('/products/$id', '/resources/single-product.php');

Route::get('/brands', '/resources/brands.php');
Route::get('/categories', '/resources/categories.php');
Route::get('/users', '/resources/users.php');
