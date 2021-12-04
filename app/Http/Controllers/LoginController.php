<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class LoginController extends Controller
{
    public function login(Request $request) {
        if (auth()->check()) {
            return redirect()->to('/');
        }
        return view('login', $request->only('username'));
    }

    public function doLogin(Request $request) {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'required|alphaNum|min:3',
        ]);

        /**
         * I had problems with auth
         * $credentials = $request->only('username', 'password');
         * if (Auth::attempt($credentials)) {
         *    return redirect('/');
         * } */
        // so I did this instead
        $user = User::where('username', $request['username'])->first();
        if ($user->password === $request['password']) {
            Auth::login($user);
            return redirect('/');
        }

        return redirect()->action(
            [self::class, 'login'],
            request(['username']),
        );
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

    protected function redirectTo() {
        return '/';
    }
}
