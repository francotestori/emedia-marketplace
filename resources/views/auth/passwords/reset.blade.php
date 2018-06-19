@extends('layouts.emedia-layout')

@section('metadata')
    <meta name="description" content="">
    <title>eMediaMarket</title>
@endsection

@section('content')
    <section class="login">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        <div class="form-anunciantes center-block">
            {{Form::open(['url' => 'password/reset', 'class' => 'formulario'])}}
            <h3>{{Lang::get('titles.reset')}}</h3>

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {{Form::label('email', Lang::get('forms.register.email'), ['class' => 'control-label'])}}
                {{Form::email('email', $email, ['class' => 'form-control'])}}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">{{Lang::get('forms.register.password')}}</label>
                <input id="password" type="password" class="form-control" name="password" required autofocus>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="control-label">{{Lang::get('forms.register.confirmation')}}</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-primary boton-funciona editores-boton"><strong>{{Lang::get('forms.basic.reset')}}</strong></button>
            </div>
            {{Form::close()}}

        </div>
    </section>
@endsection
