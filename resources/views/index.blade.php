@extends('layout')
@section('content')
    <h2>Welcome</h2>
    @if(!empty($user))
         Welcome {{ $user->first_name }} {{ $user->last_name }} you are logged in <a href="/logout">logout</a>.
    @else
        You are not logged in, <a href="/login">login</a>.
    @endif
@endsection
