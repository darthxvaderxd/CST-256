<?php
namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public function index() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!auth()->check()) {
            return redirect()->to('/login');
        }
        return view('profile', [
            'profile' => $profile,
            'user'    => $user,
        ]);
    }

    public function create(Request $request) {
        if (!auth()->check()) {
            return redirect()->to('/login');
        }

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $this->validate(request(), [
            'title'       => 'required',
            'description' => 'required',
            'skills'      => 'required',
        ]);

        if (!$profile) {
            Profile::create([
                'user_id'     => $request['user_id'],
                'title'       => $request['title'],
                'description' => $request['description'],
                'skills'      => $request['skills'],
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            $profile->title = $request['title'];
            $profile->description = $request['description'];
            $profile->skills = $request['skills'];
            $profile->updated_at = date('Y-m-d H:i:s');
            $profile->save();
        }

        return redirect()->to('/profile');
    }
}
