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
                {{Lang::get('titles.tufts.login.advertiser.who')}}
                <a href="{{route('login',['role' => 'advertiser'])}}">{{Lang::get('titles.tufts.login.advertiser.action')}}</a>
                {{Lang::get('titles.tufts.login.advertiser.activity')}}
                <br>
                {{Lang::get('titles.tufts.login.advertiser.decorator')}}
            </p>
        @elseif($requested != null && strtolower($requested) == strtolower($editor->name))
            <p>
                {{Lang::get('titles.tufts.login.editor.who')}}
                <a href="{{route('login',['role' => 'editor'])}}">{{Lang::get('titles.tufts.login.editor.action')}}</a>
                {{Lang::get('titles.tufts.login.editor.activity')}}
                <br>
                {{Lang::get('titles.tufts.login.editor.decorator')}}
            </p>
        @else
            <p>
                <a href="{{route('login')}}" class="login-editores">{{Lang::get('titles.tufts.login.common.action')}}</a>
                {{Lang::get('titles.tufts.login.common.activity')}}<br>
                {{Lang::get('titles.tufts.login.common.decorator')}}
            </p>
        @endif
    </section>
@endsection
