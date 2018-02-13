@extends('layouts.emedia-layout')

@section('content')
    <section class="login">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        <div class="form-anunciantes center-block">
            @include('auth.login.form')
        </div>

        @if($requested != null && strtolower($requested) == strtolower($advertiser->name))
            <p>
                ¿Eres anunciante?
                <a href="{{route('login',['role' => 'advertiser'])}}">Inicia sesión</a>
                y vende posts
                <br>
                patrocinados y menciones en redes socialess</p>
        @elseif($requested != null && strtolower($requested) == strtolower($editor->name))
            <p>
                ¿Eres editor?
                <a href="{{route('login',['role' => 'editor'])}}" class="login-editores">Inicia sesión</a>
                y vende posts
                <br>
                patrocinados y menciones en redes sociales</p>
        @else
            <p>
                <a href="{{route('login')}}" class="login-editores">Inicia sesión</a>
                y conectate con nuestra red<br>
                para expandir tus horizontes</p>
        @endif
    </section>
@endsection
