<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function create() {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'username'   => 'required',
            'email'      => 'required|email',
            'password'   => 'required',
        ]);

        $user = User::create(request([
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
        ]));

        auth()->login($user);

        redirect()->to('/');
    }
}
