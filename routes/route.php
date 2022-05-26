<?php require __DIR__ . "/../vendor/autoload.php";

use App\Router\Route;

Route::get('/test', 'test');
Route::get('/', 'index');

// login
Route::get('/login/secret/' . md5(secretKey('secret_login')), 'auth.login');

Route::post('/login/secret/' . md5(secretKey('secret_login')))
    ->controller(App\Controllers\LoginController::class)
    ->function('adminLogin');

// Route::post('admin_login')->controller(App\Controllers\LoginController::class, 'adminLogin')->name('name_action");

// Route::post('/login/secret/' . md5(secretKey('secret_login')), 'LoginController@adminLogin');

Route::post('log-out', 'LoginController@logOut'); // bug

// product
Route::get('/products', 'product.products');
Route::get('/products/$id', 'product.single-product');

Route::get('/brands', 'brand.brands');
Route::get('/categories', 'category.categories');
Route::get('/users', 'user.users');
