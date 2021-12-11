<?php
namespace App\Http\Controllers;

use App\Models\JobHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobHistoryController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();
        $jobHistory = JobHistory::where('user_id', $user->id)->get();

        $id = $request['id'] ?? 0;
        $job = null;

        if ($id > 0) {
            $job = JobHistory::where('id', $id)->first();
        }

        if (!auth()->check()) {
            return redirect()->to('/login');
        }

        return view('job_history', [
            'jobHistories' => $jobHistory,
            'user'         => $user,
            'job'          => $job,
        ]);
    }

    public function create(Request $request) {
        if (!auth()->check()) {
            return redirect()->to('/login');
        }

        $user = Auth::user();
        $id = $request['id'] ?? 0;
        $jobHistory = JobHistory::where('id', $id)
            ->orderBy('start_date', 'DESC')
            ->first();

        $this->validate(request(), [
            'title'       => 'required',
            'description' => 'required',
            'start_date'  => 'required',
        ]);

        if (!$jobHistory) {
            JobHistory::create([
                'user_id'     => $user->id,
                'title'       => $request['title'],
                'description' => $request['description'],
                'start_date'  => $request['start_date'],
                'end_date'    => $request['end_date'],
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        } else {
            $jobHistory->title = $request['title'];
            $jobHistory->description = $request['description'];
            $jobHistory->start_date = $request['start_date'];
            $jobHistory->end_date = $request['end_date'];
            $jobHistory->updated_at = date('Y-m-d H:i:s');
            $jobHistory->save();
        }

        return redirect()->to('/job_history');
    }
}
