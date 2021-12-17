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

Route::get(
    '/',
    [
        \App\Http\Controllers\HomeController::class,
        'index',
    ],
);

Route::get(
    '/register',
    [
        \App\Http\Controllers\RegistrationController::class,
        'register',
    ]
);

Route::post(
    '/register',
    [
        \App\Http\Controllers\RegistrationController::class,
        'create',
    ]
);

Route::get(
    '/logout',
    [
        \App\Http\Controllers\LoginController::class,
        'logout',
    ]
);

Route::get(
    '/login',
    [
        \App\Http\Controllers\LoginController::class,
        'login',
    ]
);

Route::post(
    '/login',
    [
        \App\Http\Controllers\LoginController::class,
        'doLogin',
    ]
);

Route::get(
    '/profile',
    [
        \App\Http\Controllers\ProfileController::class,
        'index',
    ]
);

Route::post(
    '/profile',
    [
        \App\Http\Controllers\ProfileController::class,
        'create',
    ]
);


Route::get(
    '/job_history',
    [
        \App\Http\Controllers\JobHistoryController::class,
        'index',
    ]
);

Route::post(
    '/job_history',
    [
        \App\Http\Controllers\JobHistoryController::class,
        'create',
    ]
);

Route::get(
    '/education',
    [
        \App\Http\Controllers\EducationController::class,
        'index',
    ]
);

Route::post(
    '/education',
    [
        \App\Http\Controllers\EducationController::class,
        'create',
    ]
);

Route::get(
    '/admin/users',
    [
        \App\Http\Controllers\AdminUserManagmentController::class,
        'index',
    ]
);

Route::get(
    '/admin/users/edit',
    [
        \App\Http\Controllers\AdminUserManagmentController::class,
        'editUser',
    ]
);

Route::post(
    '/admin/users/edit',
    [
        \App\Http\Controllers\AdminUserManagmentController::class,
        'updateUser',
    ]
);

Route::get(
    '/admin/users/delete',
    [
        \App\Http\Controllers\AdminUserManagmentController::class,
        'deleteUser',
    ]
);
