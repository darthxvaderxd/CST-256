<form action="/dologin" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    username: <input type="text" id="username" name="username" /><br />
    password: <input type="password" id="password" name="password" /><br />
    <input type="submit" />
</form>
