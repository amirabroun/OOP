<?php

use App\Router\Route;

Route::get('/', 'index');

Route::get('/test', function () {
    redirect()->route('/');
});

// login
Route::get('/login/secret/' . md5(secretKey('secret_login')), 'auth.login');
Route::post('/login/secret/' . md5(secretKey('secret_login')))
    ->controller(App\Controllers\LoginController::class)
    ->function('adminLogin');

Route::post('logOut', 'LoginController@logOut');

// product
Route::get('/products', 'product.products');
Route::get('/products/{id}', 'product.single-product');

Route::get('/brands', 'brand.brands');
Route::get('/categories', 'category.categories');
Route::get('/users', 'user.users');

throw new ErrorException('(' . originBaseUrl() . uri() . ' : route not exist)', 0, 1, 'route', 0);
