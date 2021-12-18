<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController3 extends Controller
{
    function index() {
        return view('login3');
    }

    function validateForm(Request $request) {
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'
        ];

        // Run Data Validation Rules
        $this->validate($request, $rules);
    }

    function login(Request $request) {
        $this->validateForm($request);
        $user = UserModel::where('username', $request['username'])->first();

        if ($user && $user->password === $request['password']) {
            return view('loginpassed', [ 'user' => $user ]);
        } else {
            return 'Login failed';
        }
    }
}
