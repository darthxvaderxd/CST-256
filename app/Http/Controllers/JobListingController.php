<?php
namespace App\Http\Controllers;


use App\Models\User;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSearchController extends Controller {
    public function index(Request $request)
    {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $search = $request['search'] ?? '';
        $job_search = [];

        if (!empty($search)) {
            $job_listings = JobListing::where('job_title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->get();
        }

        return view('job_search', [
            'user' => $this->user,
            'job_listings' => $job_listings,
            'search' => $search,
        ]);
    }
}
