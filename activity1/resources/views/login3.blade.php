@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
    <!-- Display all the Data Validation Rule Errors -->
    <?php
    if($errors->count() != 0)
    {
        echo "<h5>List of Errors</h5>";
        foreach($errors->all() as $message)
        {
            echo $message . "<br/>";
        }
    }
    ?>

    <form action="/dologin3" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        username: <input type="text" id="username" name="username" /><br />
        password: <input type="password" id="password" name="password" /><br />
        <input type="submit" />
    </form>
@endsection
