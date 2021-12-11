@extends('layout')

@section('title')
    Admin User Management
@endsection

@section('content')
    <h2>User Management</h2>
    <table class="table">
        <tr>
            <th>id</th>
            <th>username</th>
            <th>name</th>
            <th>email</th>
            <th>role</th>
            <th>created</th>
            <th>active</th>
            <th>actions</th>
        </tr>
        @forelse ($users as $index => $u)
            <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                <td>{{ $u['id'] }}</td>
                <td>{{ $u['first_name'] }} {{ $u['last_name'] }}</td>
                <td>{{ $u['username'] }}</td>
                <td>{{ $u['email'] }}</td>
                <td>{{ $u['role'] ?? ''}}</td>
                <td>{{ $u['created_at'] }}</td>
                <td>
                    @if ($u['active'] == 1)
                        <div class="green">Yes</div>
                    @else
                        <div class="red">No</div>
                    @endif
                </td>
                <td>
                    <a href="/admin/users/edit?id={{ $u['id'] ?? 0 }}" class="button">Edit</a>
                    <a href="/admin/users/delete?id={{ $u['id'] ?? 0 }}" class="button">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">This is weird...</td></tr>
        @endforelse
    </table>
@endsection
