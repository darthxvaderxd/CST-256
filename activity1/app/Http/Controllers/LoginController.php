<?php

namespace App\Http\Controllers;

use App\Http\Service\SecurityDAO;
use App\Http\Service\Utility\MyLogger1;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index() {
        MyLogger1::info("Entering LoginController::index()");
        return view('login');
    }

    function index2() {
        return view('login2');
    }

    function login(Request $request) {
        MyLogger1::info("Entering LoginController::login()");
        MyLogger1::info("Parameters are: ", [
            "username" => $request['username'],
            "password" => $request['password'],
        ]);

        $user = SecurityDAO::validateLogin($request['username'], $request['password']);

        if ($user) {
            MyLogger1::info("Exit LoginController::login() with login passing");
            return view('loginpassed', [ 'user' => $user ]);
        } else {
            MyLogger1::info("Exit LoginController::login() with failing passing");
            return 'Login failed';
        }
    }
}
