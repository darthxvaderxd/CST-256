@extends('layout')

@section('title')
    Admin Job Listing {{ $jobListing->id ?? 0 }}
@endsection

@section('content')
    <h2>Admin Job Listing : {{ $jobListing->id ?? 'New' }}</h2>

    <form method="POST" action="/admin/jobs/edit">
    {{ csrf_field() }}

    <input type="hidden" name="id" id="id" value="{{ $jobListing->id ?? 0 }}" />

    <!-- if there are login errors, show them here -->
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <span class="errors">{{ $errors->first('company_name') }}</span>
            <br />
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $jobListing->company_name ?? '' }}">
        </div>

        <div class="form-group">
            <label for="title">Job Title</label>
            <span class="errors">{{ $errors->first('title') }}</span>
            <br />
            <input type="text" class="form-control" id="title" name="title" value="{{ $jobListing->job_title ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">Job Description</label>
            <span class="errors">{{ $errors->first('description') }}</span>
            <br />
            <textarea id="description" name="description">{{ $jobListing->description ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <span class="errors">{{ $errors->first('link') }}</span>
            <br />
            <input type="text" class="form-control" id="link" name="link" value="{{ $jobListing->link ?? '' }}">
        </div>

        <div class="form-group">
            <label for="amount">Pay</label>
            <span class="errors">{{ $errors->first('amount') }}</span>
            <span class="errors">{{ $errors->first('pay_type') }}</span>
            <br />
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $jobListing->amount ?? '' }}">
            <br />
            <select name="pay_type" id="pay_type">
                <option value="">Select One</option>
                <option value="1" {{ $jobListing && $jobListing->pay_type === 1 ? 'selected="selected"' : '' }}>Hourly</option>
                <option value="2" {{ $jobListing && $jobListing->pay_type === 2 ? 'selected="selected"' : '' }}>Yearly</option>
            </select>
        </div>

        <div class="form-group">
            <br />
            <button style="cursor:pointer" type="submit" class="btn btn-primary">
                @if($jobListing)
                    Update Listing
                @else
                    Create Listing
                @endif
            </button>
        </div>
    </form>
@endsection
