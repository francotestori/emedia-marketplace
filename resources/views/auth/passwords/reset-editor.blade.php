@extends('layouts.emedia-layout')

@section('content')
    <section class="">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        <div class="form-anunciantes center-block">
            <form class="formulario"  method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <img src="{{asset('img/password-editores.png')}}" class="img-responsive center-block">
                <p>Introduce tu dirección de email y te
                    enviaremos las instrucciones para solicitar
                    una nueva contraseña</p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button class="btn btn-primary btn-lg boton-funciona anunciantes-boton"><strong>Resetear</strong></button>
                <a href="{{route('register.editor')}}" class="center-block">Registrarse como anunciante</a><br>
                <a href="{{ route('password.reset-editor') }}" class="center-block">¿Olvidó su contraseña?</a>
            </form>
        </div>
        <p></p>
    </section>
@endsection
