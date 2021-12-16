<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class AdminUserManagmentController extends Controller {
    public function searchArray($needle, $key, $array) {
        foreach ($array as $value) {
            if ($value[$key] == $needle) {
                return $value;
            }
        }
        return null;
    }

    public function index() {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $roles = Role::all()->toArray();
        $users = User::all()->toArray();

        for ($i = 0; $i < sizeof($users); $i += 1) {
            if (empty($users[$i])) {
                continue;
            }
            $role = $this->searchArray($users[$i]['role_id'], 'id', $roles);
            if ($role) {
                $users[$i]['role'] = $role['role'];
            }
        }

        return view('admin-user-management', [
            'user'  => $this->user,
            'users' => $users,
        ]);
    }

    public function editUser(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $id = $request['id'];
        $roles = Role::all()->toArray();
        $user = User::where('id', $id)->first();
        $user->role = $this->searchArray($user->role_id, 'id', $roles);

        return view('admin-user-management-edit', [
            'user'     => $this->user,
            'editUser' => $user,
            'roles'    => $roles,
        ]);
    }

    public function updateUser(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $this->validate(request(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
        ]);

        $id = $request['id'] ?? 0;
        $password = $request['password'] ?? false;
        $user = User::where('id', $id)->first();

        $user->first_name = $request['first_name'] ?? $user->first_name;
        $user->last_name = $request['last_name'] ?? $user->last_name;
        $user->email = $request['email'] ?? $user->email;
        $user->role_id = $request['role_id'] ?? $user->role_id;
        $user->active = $request['active'] === "1";

        if ($password && $password !== '') {
            $user->password = $password;
        }

        $user->save();

        return redirect()->to('/admin/users');
    }

    function deleteUser(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        try {
            $id = $request['id'] ?? 0;
            $user = User::where('id', $id)->first();
            if ($user) {
                $user->delete();
            }
        } catch(Exception $e) {
            // swallow errror;
        }
        return redirect()->to('/admin/users');
    }
}
