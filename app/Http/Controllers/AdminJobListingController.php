<?php
namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class AdminJobListingController extends Controller {
    public function index() {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $jobListings = JobListing::all()->toArray();

        return view('admin-job-listings', [
            'user'        => $this->user,
            'jobListings' => $jobListings,
        ]);
    }

    public function editJobListing(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $id = $request['id'];
        $jobListing = JobListing::where('id', $id)->first();

        return view('admin-job-listing', [
            'user'       => $this->user,
            'jobListing' => $jobListing,
        ]);
    }

    public function updateJobListing(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        $this->validate(request(), [
            'company_name' => 'required',
            'title'        => 'required',
            'description'  => 'required',
            'amount'       => 'required',
            'pay_type'     => 'required',
        ]);

        $id = $request['id'] ?? 0;
        $jobListing = JobListing::where('id', $id)->first();

        if (empty($jobListing)) {
            JobListing::create([
                'company_name' => $request['company_name'],
                'job_title'    => $request['title'],
                'link'         => $request['link'] ?? '',
                'description'  => $request['description'],
                'amount'       => $request['amount'],
                'pay_type'     => $request['pay_type'],
            ]);
        } else {
            $jobListing->company_name = $request['company_name'];
            $jobListing->job_title = $request['title'];
            $jobListing->link = $request['link'] ?? '';
            $jobListing->description = $request['description'];
            $jobListing->amount = $request['amount'];
            $jobListing->pay_type = $request['pay_type'];
            $jobListing->save();
        }

        return redirect()->to('/admin/jobs');
    }

    function deleteJob(Request $request) {
        $isAdmin = $this->validateAdminUser();

        if ($isAdmin !== true) {
            return $isAdmin;
        }

        try {
            $id = $request['id'] ?? 0;
            $jobListing = JobListing::where('id', $id)->first();
            if ($jobListing) {
                $jobListing->delete();
            }
        } catch(Exception $e) {
            // swallow error;
        }
        return redirect()->to('/admin/jobs');
    }
}
