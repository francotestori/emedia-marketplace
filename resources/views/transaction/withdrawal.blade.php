<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<h2>Withdrawal Request</h2>

<div class="row">
    <div class="col-lg-12">
        <h3>Account Details</h3>
        <div class="form-group">
            <label for="sender" class="form-control">{{Lang::get('messages.sender')}}</label>
            <input name="sender" class="form-control" value="{{$sender}}" readonly>
        </div>
        <div class="form-group">
            <label for="paypal" class="form-control">{{Lang::get('messages.paypal_account')}}</label>
            <input name="paypal" class="form-control" value="{{$paypal}}" readonly>
        </div>
        <div class="form-group">
            <label for="cbu" class="form-control">{{Lang::get('messages.cbu')}}</label>
            <input name="cbu" class="form-control" value="{{$cbu}}" readonly>
        </div>
        <div class="form-group">
            <label for="alias" class="form-control">{{Lang::get('messages.alias')}}</label>
            <input name="alias" class="form-control" value="{{$alias}}" readonly>
        </div>
        <div class="form-group">
            <label for="sender" class="form-control">{{Lang::get('messages.amount')}}</label>
            <input name="amount" class="form-control" value="{{$amount}}" readonly>
        </div>

        <a class="btn btn-success" href="{{$url}}">Authorize Withdrawal</a>

        <h4>Comments</h4>
        <p>{{$comment}}</p>
    </div>

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>