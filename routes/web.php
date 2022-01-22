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

/* Index */
Route::get(
    '/',
    [
        \App\Http\Controllers\HomeController::class,
        'index',
    ],
);

/* Registration */
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

/* Authentication */
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

/* Profile */
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


/* JobHistory */
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

/* Education */
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

/* Admin User Managment */
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

/* Admin Job Listing */
Route::get(
    '/admin/jobs',
    [
        \App\Http\Controllers\AdminJobListingController::class,
        'index',
    ]
);

Route::get(
    '/admin/jobs/edit',
    [
        \App\Http\Controllers\AdminJobListingController::class,
        'editJobListing',
    ]
);

Route::post(
    '/admin/jobs/edit',
    [
        \App\Http\Controllers\AdminJobListingController::class,
        'updateJobListing',
    ]
);

Route::get(
    '/admin/jobs/delete',
    [
        \App\Http\Controllers\AdminJobListingController::class,
        'deleteJob',
    ]
);

/* Affinity Groups */
Route::get(
    '/groups',
    [
        \App\Http\Controllers\GroupController::class,
        'index',
    ]
);

Route::post(
    '/groups',
    [
        \App\Http\Controllers\GroupController::class,
        'index',
    ]
);

Route::get(
    '/group',
    [
        \App\Http\Controllers\GroupController::class,
        'view',
    ]
);

Route::post(
    '/group/create',
    [
        \App\Http\Controllers\GroupController::class,
        'create',
    ]
);

Route::post(
    '/group',
    [
        \App\Http\Controllers\GroupController::class,
        'join',
    ]
);

Route::post(
    '/group/leave',
    [
        \App\Http\Controllers\GroupController::class,
        'leave',
    ]
);

Route::get(
    '/groups/my',
    [
        \App\Http\Controllers\GroupController::class,
        'userGroups',
    ]
);

/* Job listings */
Route::get(
    '/job_listings',
    [
        \App\Http\Controllers\JobListingController::class,
        'index',
    ]
);

Route::get(
    '/job_listing',
    [
        \App\Http\Controllers\JobListingController::class,
        'view',
    ]
);

Route::get(
    '/job_listing/apply',
    [
        \App\Http\Controllers\JobListingController::class,
        'apply',
    ]
);

// Rest API stuff

Route::resource(
    '/api/users',
    \App\Http\RestControllers\ProfileController::class,
);

Route::resource(
    '/api/jobs',
    \App\Http\RestControllers\JobListingController::class,
);
