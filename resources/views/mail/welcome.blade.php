<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<h2>Verify Your Email Address</h2>

<div>
    <p>
        Thanks for creating an account with the verification demo app.
        Please follow the link below to verify your email address
        <a href="{{ URL::to('register/verify/' . $activation_code) }}" class="btn btn-info"><span>Verify Account</span></a>
    </p>
    <br/>

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>