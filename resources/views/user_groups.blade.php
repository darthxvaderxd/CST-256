@extends('layout')

@section('title')
    My Affinity Groups
@endsection

@section('content')
    <h2>My Affinity Groups</h2>
    @if (!empty($group_users))
        <table class="table">
            <tr>
                <th>Group</th>
                <th>Member Count</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($group_users as $group_user)
                <tr>
                    <td>{{ ucwords($group_user->group->group) ?? 'ERROR' }}</td>
                    <td>{{ $group_user->group->user_count ?? 0 }}</td>
                    <td>
                        <a href="/group?id={{ $group_user->group_id ?? 0 }}" class="button">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>You have no affinity groups that you have joined find <a href="/groups">some</a></p>
    @endif
@endsection
