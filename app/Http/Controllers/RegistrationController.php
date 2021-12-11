<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

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

        $role = Role::where('role', 'user')->first();

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name'  => $request['last_name'],
            'username'   => $request['username'],
            'email'      => $request['email'],
            'password'   => $request['password'],
            'role_id'    => $role->id,
        ]);

        return redirect()->to('/login?username='.$request['username']);
    }
}
