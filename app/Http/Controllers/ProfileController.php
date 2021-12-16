<?php
namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public function index() {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('profile', [
            'profile' => $profile,
            'user'    => $user,
        ]);
    }

    public function create(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $this->validate(request(), [
            'title'       => 'required',
            'description' => 'required',
            'skills'      => 'required',
        ]);

        if (!$profile) {
            Profile::create([
                'user_id'     => $user->id,
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
