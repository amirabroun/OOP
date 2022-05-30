<?php

use App\Router\Route;

Route::get('/test', 'test');
Route::get('/', 'index');

Route::get('/test/{name}', 'test');

Route::get('users/{name}/mobile/{phoneNumber}', 'test');
Route::get('users/{name}', 'test');

// login
Route::get('/login/secret/' . md5(secretKey('secret_login')), 'auth.login');
// Route::post('/login/secret/' . md5(secretKey('secret_login')), 'LoginController@adminLogin');
Route::post('/login/secret/' . md5(secretKey('secret_login')))
    ->controller(App\Controllers\LoginController::class)
    ->function('adminLogin');

Route::post('log-out', 'LoginController@logOut');

// product
Route::get('/products', 'product.products');
Route::get('/products/{id}', 'product.single-product');

Route::get('/brands', 'brand.brands');
Route::get('/categories', 'category.categories');
Route::get('/users', 'user.users');
