@extends('layout')
@section('content')
    <h2>Login</h2>
    <form method="POST" action="/login">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="username">Username</label>
            <span class="errors">{{ $errors->first('username') }}</span>
            <br />
            <input type="text" class="form-control" id="username" name="username" value="{{ $username ?? '' }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <span class="errors">{{ $errors->first('password') }}</span>
            <br />
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <br />
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
