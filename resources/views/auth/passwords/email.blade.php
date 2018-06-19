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
            {{Form::open(['route' => 'password.email', 'class' => 'formulario'])}}

            <h3>{{Lang::get('titles.reset')}}</h3>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {{Form::label('email', Lang::get('forms.login.email'), ['class' => 'control-label'])}}
                {{Form::email('email', Input::old('email'), ['class' => 'form-control',  'required' => true])}}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
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
