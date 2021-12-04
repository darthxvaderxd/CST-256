<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class RegistrationController extends Controller
{
    public function register(Request $request) {
        if (auth()->check()) {
            return redirect()->to('/');
        }
        return view('register');
    }

    public function create(Request $request) {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'username'   => 'required',
            'email'      => 'required|email',
            'password'   => 'required|alphaNum|min:3',
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name'  => $request['last_name'],
            'username'   => $request['username'],
            'email'      => $request['email'],
            'password'   => $request['password'],
        ]);

        return redirect()->to('/login?username='.$request['username']);
    }
}
