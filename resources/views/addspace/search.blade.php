@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
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
                <div class="panel-titulo2">
                    <h3>{{Lang::get('messages.web_or_blog')}}</h3>
                </div>
                <br>
                @include('addspace.search_form')
                <hr>
                @each('addspace.preview_group', $clusters, 'addspaces')
        </div>
    </div>
@stop

@section('custom-js')
    <script src="{{asset('js/bootstrap-slider.js')}}"></script>
    <script type="text/javascript">
        $('#ex1').slider({
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
    </script>
@endsection
