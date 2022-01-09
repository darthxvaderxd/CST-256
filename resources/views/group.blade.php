@extends('layout')

@section('title')
    Affinity Groups - {{ ucwords($group->group ?? 'Error') }}
@endsection

@section('content')
    @if (!empty($group))
        <h2>{{ ucwords($group->group ?? 'Error') }}</h2>
        <form method="POST" action="/group{{ !empty($group->group_user) ? '/leave' : ''  }}">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{ $group->id ?? 0 }}" />
            <div class="form-group">
                @if (!empty($group->group_user))
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Leave</button>
                @else
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Join</button>
                @endif
            </div>
        </form>

        <br />

        <h2>Users in group</h2>
        @forelse ($group->users as $u)
            <div class="user">
                <div class="form-group">
                    <b>{{ $u->first_name ?? ''  }} {{ $u->last_name }}</b> <a href="#">View Profile</a>
                </div>
            </div>
        @empty
            <p>There are no users in this group</p>
        @endforelse
    @else
        Error invalid group
    @endif
@endsection
