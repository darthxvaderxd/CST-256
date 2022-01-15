<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return  'Hello World';
});

Route::get('/hello_view', function () {
    return  view('hello');
});

Route::get('/customer', [
    \App\Http\Controllers\TestController::class,
    'testCustomerProduct',
]);

Route::get('/test', [
    \App\Http\Controllers\TestController::class,
    'test',
]);

Route::get('/test2', [
    \App\Http\Controllers\TestController::class,
    'test2',
]);

Route::get('/askme', [
    \App\Http\Controllers\WhatsMyNameController::class,
    'index',
]);

Route::post('/whoami', [
    \App\Http\Controllers\WhatsMyNameController::class,
    'post',
]);

Route::get('/login', [
    \App\Http\Controllers\LoginController::class,
    'index',
]);

Route::get('/login2', [
    \App\Http\Controllers\LoginController::class,
    'index2',
]);

Route::post('/dologin', [
    \App\Http\Controllers\LoginController::class,
    'login',
]);

Route::get('/login3', [
    \App\Http\Controllers\LoginController3::class,
    'index',
]);

Route::post('/dologin3', [
    \App\Http\Controllers\LoginController3::class,
    'login',
]);

Route::resource('/usersrest', \App\Http\Controllers\UsersRestController::class);
