@extends('layout')

@section('title')
    Admin Job Listing Management
@endsection

@section('content')
    <h2>Admin Job Listing Management</h2>
    <div class="right" style="margin-bottom: 0.8rem;">
        <a href="/admin/jobs/edit" class="button">+ Add</a>
    </div>
    <table class="table">
        <tr>
            <th>id</th>
            <th>company name</th>
            <th>job title</th>
            <th>pay</th>
            <th>created</th>
            <th>updated</th>
            <th>actions</th>
        </tr>
        @forelse ($jobListings as $index => $job)
            <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                <td>{{ $job['id'] }}</td>
                <td>{{ $job['company_name'] }}</td>
                <td>{{ $job['job_title'] }}</td>
                <td>
                    ${{ $job['amount'] }}
                    @if ($job['pay_type'] === 1)
                        / hr
                    @endif
                </td>
                <td>{{ $job['created_at'] }}</td>
                <td>{{ $job['updated_at'] }}</td>
                <td>
                    <a href="/admin/jobs/edit?id={{ $job['id'] ?? 0 }}" class="button">Edit</a>
                    <a href="/admin/jobs/delete?id={{ $job['id'] ?? 0 }}" class="button">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">There are no job listings</td></tr>
        @endforelse
    </table>
@endsection
