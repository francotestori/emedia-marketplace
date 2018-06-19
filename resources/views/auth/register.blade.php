@extends('layouts.emedia-layout')

@section('metadata')
    <meta name="description" content="">
    @if($requested == null)
        <title>{{Lang::get('seo.register.common')}}</title>
    @elseif($requested == 'advertiser')
        <title>{{Lang::get('seo.register.advertiser')}}</title>
    @elseif($requested == 'editor')
        <title>{{Lang::get('seo.register.editor')}}</title>
    @else
        <title>{{Lang::get('seo.register.common')}}</title>
    @endif
@endsection

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
