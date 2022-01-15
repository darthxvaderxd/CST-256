@extends('layout')

@section('title')
    Job Listing {{ $job_listing->job_title ?? '' }}
@endsection

@section('content')
    <h2>Job Listing : {{ $job_listing->job_title ?? '' }}</h2>

    <form method="GET" action="/job_listing/apply">
        {{ csrf_field() }}

        <input type="hidden" name="id" id="id" value="{{ $job_listing->id ?? 0 }}" />

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <br />
            {{ $job_listing->company_name ?? '' }}
        </div>

        <div class="form-group">
            <label for="title">Job Title</label>
            <br />
            {{ $job_listing->job_title ?? '' }}
        </div>

        <div class="form-group">
            <label for="description">Job Description</label>
            <br />
            {{ $job_listing->description ?? '' }}
        </div>

        <div class="form-group">
            <label for="link">Link</label>
            <br />
            {{ $job_listing->link ?? '' }}
        </div>

        <div class="form-group">
            <label for="amount">Pay</label>
            <br />
            ${{ $job_listing['amount'] }}
            @if ($job_listing['pay_type'] === 1)
                / hr
            @endif
        </div>

        <div class="form-group">
            <br />
            <button style="cursor:pointer" type="submit" class="btn btn-primary">
                Apply
            </button>
        </div>
    </form>
@endsection
