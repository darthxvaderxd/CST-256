<?php
namespace App\Http\RestControllers;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\JobHistory;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::where('id', (int) $id)
            ->first();

        if ($id < 2 || !$user) { // no user found return and not admin user
            return response()->json(['message' => 'Not Found!'], 404);
        }

        $user->profile = Profile::where('user_id', $id)
            ->first();
        $user->education_history = Education::where('user_id', $id)
            ->get();
        $user->job_history = JobHistory::where('user_id', $id)
            ->get();

        return $user;
    }
}
