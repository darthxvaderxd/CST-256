<?php
namespace App\Http\Controllers;

use App\Models\JobHistory;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobHistoryController extends Controller {
    public function index(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $jobHistory = JobHistory::where('user_id', $user->id)
            ->orderBy('start_date', 'DESC')
            ->get();

        $id = $request['id'] ?? 0;
        $job = null;

        if ($id > 0) {
            $job = JobHistory::where('id', $id)->first();
        }

        return view('job_history', [
            'jobHistories' => $jobHistory,
            'user'         => $user,
            'job'          => $job,
        ]);
    }

    public function create(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $user = Auth::user();
        $id = $request['id'] ?? 0;
        $jobHistory = JobHistory::where('id', $id)
            ->orderBy('start_date', 'DESC')
            ->first();

        $this->validate(request(), [
            'title'        => 'required',
            'description'  => 'required',
            'start_date'   => 'required',
            'company_name' => 'required',
        ]);

        // if there isn't an affinity group for this company create it
        $group = Group::where('group', strtolower($request['company_name']))
            ->first();
        if (!$group) {
            Group::create([
                'group' => $request['company_name'],
            ]);

            $group = Group::where('group', strtolower($request['company_name']))
                ->first();
        }

        if ($group) {
            GroupUser::create([
                'group_id' => $group->id,
                'user_id'  => $user->id,
            ]);
        }

        if (!$jobHistory) {
            JobHistory::create([
                'user_id'      => $user->id,
                'title'        => $request['title'],
                'company_name' => $request['company_name'],
                'description'  => $request['description'],
                'start_date'   => $request['start_date'],
                'end_date'     => $request['end_date'],
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
        } else {
            $jobHistory->title = $request['title'];
            $jobHistory->company_name = $request['company_name'];
            $jobHistory->description = $request['description'];
            $jobHistory->start_date = $request['start_date'];
            $jobHistory->end_date = $request['end_date'];
            $jobHistory->updated_at = date('Y-m-d H:i:s');
            $jobHistory->save();
        }

        return redirect()->to('/job_history');
    }
}
