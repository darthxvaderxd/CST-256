<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    public function index() {
        return view('index', [
            'user' => Auth::user(),
        ]);
    }
}
