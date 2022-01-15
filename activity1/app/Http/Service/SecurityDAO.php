<?php
namespace App\Http\Service;

use App\Http\Service\Utility\MyLogger1;
use App\Models\UserModel;

class SecurityDAO {
    static public function validateLogin($username, $password) {
        MyLogger1::info("Enter SecurityDAO::validateLogin() with login passing");

        MyLogger1::info("SecurityDAO Parameters are: ", [
            "username" => $username,
            "password" => $password,
        ]);

        $user = UserModel::where('username',$username)->first();

        if ($user && $user->password === $password) {
            MyLogger1::info("Exit SecurityDAO::validateLogin() with login passing");
            return $user;
        } else {
            MyLogger1::info("Exit SecurityDAO::validateLogin() with failing passing");
            return false;
        }
    }

    static public function findAllUsers() {
        return UserModel::all();
    }

    static public function getUserById($id) {
        return UserModel::where('id', $id)
            ->first();
    }
}
