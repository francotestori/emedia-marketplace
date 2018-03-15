<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<h2>Log in with your password</h2>

<div>
    <p>
        An account has been created for you.
        Please follow the link below and attempt to log in with the password provided.
        <h5>{{$password}}</h5>
        <a href="{{url('login')}}" class="btn btn-info"><span>Login</span></a>
    </p>
    <br/>

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>