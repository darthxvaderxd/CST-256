@extends('layout')

@section('title')
    My Profile
@endsection

@section('content')
    <h2>My Profile</h2>
    <form method="GET" action="/job_listings">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="search">Search</label>
            <br />
            <input type="text" class="form-control" id="search" name="search" value="{{ $search ?? '' }}">
        </div>
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <br />

    @if (!empty($job_listings))
        <table class="table">
            <tr>
                <th>Company</th>
                <th>Job Title</th>
                <th>Pay</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($job_listings as $job_listing)
                <tr>
                    <td>{{ $job_listing->company_name ?? '' }}</td>
                    <td>{{ $job_listing->job_title ?? '' }}</td>
                    <td>
                        ${{ $job_listing['amount'] }}
                        @if ($job_listing['pay_type'] === 1)
                            / hr
                        @endif
                    </td>
                    <td>
                        <a class="button" href="/job_listing?id={{ $job_listing->id ?? 0 }}">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="form-group">
            There is currently no job listings that meet your search criteria
        </div>
    @endif
@endsection
