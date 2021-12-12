<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index() {
        return view('login');
    }

    function index2() {
        return view('login2');
    }

    function login(Request $request) {
        $user = UserModel::where('username', $request['username'])->first();

        if ($user && $user->password === $request['password']) {
            return view('loginpassed', [ 'user' => $user ]);
        } else {
            return 'Login failed';
        }
    }
}
