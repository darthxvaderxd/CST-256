@extends('layout')

@section('title')
    Affinity Groups - Search
@endsection

@section('content')
    <h2>Affinity Groups - Search</h2>
    <form method="GET" action="/groups">
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

    @if (!empty($groups))
        <table class="table">
            <tr>
                <th>Group</th>
                <th>Member Count</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($groups as $group)
                <tr>
                    <td>{{ ucwords($group->group) }}</td>
                    <td>{{ $group->user_count ?? 0 }}</td>
                    <td>
                        <a href="/group?id={{ $group->id ?? 0 }}" class="button">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @elseif (!empty($search))
        <form method="POST" action="/group/create">
            {{ csrf_field() }}
            <input type="hidden" id="group" name="group" value="{{ $search ?? '' }}" />
            <div class="form-group">
                There is currently no group by this search criteria
            </div>
            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Create affinity group "{{ $search ?? '' }}"</button>
            </div>
        </form>
    @endif
@endsection
