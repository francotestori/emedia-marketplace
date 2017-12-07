@extends('layouts.emedia-layout')

@section('content')
    <section class="">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="form-anunciantes center-block">
            <form class="formulario" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <img src="{{asset('img/logo-editores.png')}}" class="img-responsive center-block">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input id="email" type="email" class="form-control" name="name" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" required autofocus>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">Repetir Contraseña</label>
                    <input id="password-confirm" type="password-confirm" class="form-control" name="name" required autofocus>
                    @if ($errors->has('password-confirm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="country" class="control-label">País:</label>
                    <select id="paisId" class="form-control">
                        <option value="ARG">Argentina</option>
                        <option value="BRA">Brasil</option>
                        <option value="COL">Colombia</option>
                        <option value="PER">Perú</option>
                    </select>
                </div>
                <input type="hidden" name="role" value="{{$role->id}}">
                <button class="btn btn-primary btn-lg boton-funciona editores-boton"><strong>Enviar</strong></button>
                <a href="{{route('login.editor')}}" class="center-block">Iniciar Sesión</a><br>
                <a href="{{route('password.reset-editor')}}" class="center-block">¿Olvidó su contraseña?</a>
            </form>
        </div>
        <p></p>
    </section>

@endsection
