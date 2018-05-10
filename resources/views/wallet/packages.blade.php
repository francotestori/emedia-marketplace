@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-8 emedia-title">
                    <h3>{{Lang::get('titles.packages.index')}}</h3>
                </div>
                <div class="col-md-4 pull-right emedia-title">
                    @if(Auth::user()->isManager())
                        <a href="{{route('package.create')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.create')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger" role="alert">
                {{ session('errors') }}
            </div>
        @endif

        <div class="panel-heading">
            @each('wallet.package.package_cluster', $clusters, 'packages')
        </div>
    </div>
@stop

@section('custom-js')
@endsection
