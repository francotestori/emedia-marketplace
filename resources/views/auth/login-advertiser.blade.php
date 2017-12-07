@extends('layouts.emedia-layout')

@section('content')
    <section class="login">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        <div class="form-anunciantes center-block">
            <form class="formulario" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <img src="{{asset('img/logo-anunciantes.png')}}" class="img-responsive center-block">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                </div>

                <button class="btn btn-primary btn-lg boton-funciona anunciantes-boton"><strong>Enviar</strong></button>
                <a href="{{route('register.advertiser')}}" class="center-block">Registrarse como anunciante</a><br>
                <a href="{{ route('password.reset-advertiser') }}" class="center-block">¿Olvidó su contraseña?</a>
            </form>
        </div>
        <p >¿Eres anunciante? <a href="#">Inicia sesión</a> y vende posts <br>
            patrocinados y menciones en redes socialess</p>
    </section>
@endsection
