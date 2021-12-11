@extends('layout')

@section('title')
    Register
@endsection

@section('content')
    <h2>Register</h2>
    <form method="POST" action="/register">
        {{ csrf_field() }}

        <!-- if there are login errors, show them here -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <span class="errors">{{ $errors->first('first_name') }}</span>
            <br />
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <span class="errors">{{ $errors->first('last_name') }}</span>
            <br />
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <span class="errors">{{ $errors->first('username') }}</span>
            <br />
            <input type="text" class="form-control" id="username" name="username">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <span class="errors">{{ $errors->first('email') }}</span>
            <br />
            <input type="email" class="form-control" id="email" name="email">
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
