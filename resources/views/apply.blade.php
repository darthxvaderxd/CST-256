@extends('layout')

@section('title')
    Job Listing {{ $job_listing->job_title ?? '' }} - Apply
@endsection

@section('content')
    You have applied for <b>{{ $job_listing->job_title ?? '' }}</b> at <b>{{ $job_listing->company_name ?? '' }}</b>
    <a class="button" href="/job_listings">Back</a>
@endsection
