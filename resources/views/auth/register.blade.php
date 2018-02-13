@extends('layouts.emedia-layout')

@section('content')
    <section class="">
        <div class="logo-anunciantes">
            <img src="{{asset('img/login-anunciantes.png')}}" class="img-responsive center-block">
        </div>
        <div class="form-anunciantes center-block">
            @include('auth.register.form')
        </div>
        <p></p>
    </section>
@endsection
