<?php
namespace App\Http\Controllers;


use App\Models\User;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller {
    public function index(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $search = $request['search'] ?? '';
        $job_listings = [];

        if (!empty($search)) {
            $job_listings = JobListing::where('job_title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->get();
        }

        return view('job_listings', [
            'user' => $this->user,
            'job_listings' => $job_listings,
            'search' => $search,
        ]);
    }

    public function view(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $id = $request['id'] ?? 0;

        $job_listing = JobListing::where('id', $id)
            ->first();

        return view('job_listing', [
            'user'        => $this->user,
            'job_listing' => $job_listing,
        ]);
    }

    public function apply(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $id = $request['id'] ?? 0;

        $job_listing = JobListing::where('id', $id)
            ->first();

        return view('apply', [
            'user'        => $this->user,
            'job_listing' => $job_listing,
        ]);
    }
}
