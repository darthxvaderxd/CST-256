<?php
namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller {
    public function index(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $educationHistory = Education::where('user_id', $user->id)
            ->orderBy('start_date', 'DESC')
            ->get();

        $id = $request['id'] ?? 0;
        $education = null;

        if ($id > 0) {
            $education = Education::where('id', $id)->first();
        }

        return view('education', [
            'educationHistories' => $educationHistory,
            'user'               => $user,
            'education'          => $education,
        ]);
    }

    public function create(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $id = $request['id'] ?? 0;
        $education = Education::where('id', $id)
            ->orderBy('start_date', 'DESC')
            ->first();

        $this->validate(request(), [
            'title'       => 'required',
            'description' => 'required',
            'start_date'  => 'required',
        ]);

        // if there isn't an affinity group for this company create it
        $group = Group::where('group', strtolower($request['title']))
            ->first();
        if (!$group) {
            Group::create([
                'group' => $request['title'],
            ]);

            $group = Group::where('group', strtolower($request['title']))
                ->first();

            if ($group) {
                GroupUser::create([
                    'group_id' => $group->id,
                    'user_id'  => $user->id,
                ]);
            }
        }

        if (!$education) {
            Education::create([
                'user_id'     => $user->id,
                'title'       => $request['title'],
                'description' => $request['description'],
                'start_date'  => $request['start_date'],
                'end_date'    => $request['end_date'],
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            $education->title = $request['title'];
            $education->description = $request['description'];
            $education->start_date = $request['start_date'];
            $education->end_date = $request['end_date'];
            $education->updated_at = date('Y-m-d H:i:s');
            $education->save();
        }

        return redirect()->to('/education');
    }
}
