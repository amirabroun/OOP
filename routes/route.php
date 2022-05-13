<?php

use App\Router\Route;

Route::get('/test', 'test');
Route::get('/', 'index');

// login
Route::get('/login/secret/' . md5(secretKey('secret_login')), 'auth.login');

// product
Route::get('/products', 'product.products');
Route::get('/products/$id', 'product.single-product');

Route::get('/brands', 'brand.brands');
Route::get('/categories', 'category.categories');
Route::get('/users', 'user.users');
