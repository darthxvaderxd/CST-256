@extends('layout')

@section('title')
    Admin User Management Edit {{ $editUser->username }}
@endsection

@section('content')
    <h2>User Management : Edit : {{ $editUser->username }}</h2>

    <form method="POST" action="/admin/users/edit">
    {{ csrf_field() }}

    <input type="hidden" name="id" id="id" value="{{ $editUser->id ?? 0 }}" />

    <!-- if there are login errors, show them here -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <span class="errors">{{ $errors->first('first_name') }}</span>
            <br />
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $editUser->first_name ?? '' }}">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <span class="errors">{{ $errors->first('last_name') }}</span>
            <br />
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $editUser->last_name ?? '' }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <span class="errors">{{ $errors->first('email') }}</span>
            <br />
            <input type="email" class="form-control" id="email" name="email" value="{{ $editUser->email ?? '' }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <span class="errors">{{ $errors->first('password') }}</span>
            <br />
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password">Role</label>
            <span class="errors">{{ $errors->first('role_id') }}</span>
            <br />
            <select id="role_id" name="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role['id'] }}" {{ $role['id'] === $editUser->role_id ? 'selected' : '' }}>{{ $role['role'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Enabled</label>
            <span class="errors">{{ $errors->first('role_id') }}</span>
            <br />
            <select id="active" name="active">
                <option value="1" {{ $editUser->active == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $editUser->active != 1 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <br />
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
