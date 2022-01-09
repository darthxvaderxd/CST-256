<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    protected function isValidUserForRoute($isAdminCheck = false) {
        if (!auth()->check()) {
            return redirect()->to('/login');
        }

        $this->user = Auth::user();

        if ($isAdminCheck) {
            if ($this->user->role_id !== 3) { // should be updated to compare to admin role itself
                return redirect()->to('/'); // redirect to home page
            }
        }

        return true;
    }

    protected function validateAdminUser() {
        return $this->isValidUserForRoute(true);
    }
}
