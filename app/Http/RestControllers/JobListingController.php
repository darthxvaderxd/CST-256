<?php
namespace App\Http\RestControllers;

use App\Http\Controllers\Controller;
use App\Models\JobListing;

class JobListingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return JobListing::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $job_listing = JobListing::where('id', (int) $id)
            ->first();

        if ($id < 1 || !$job_listing) { // no user found return and not admin user
            return response()->json(['message' => 'Not Found!'], 404);
        }

        return $job_listing;
    }
}
