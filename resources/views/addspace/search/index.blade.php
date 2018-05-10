@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12 emedia-title">
                    <h3>{{Lang::get('titles.addspaces.search')}}</h3>
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
            @include('addspace.search.form')
        </div>
        <br>

        <div class="panel-heading">
            @each('addspace.search.cluster', $clusters, 'addspaces')
        </div>
    </div>
@stop

@section('custom-js')
    <script src="{{asset('js/bootstrap-slider.js')}}"></script>
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
    <script type="text/javascript">
        $('#priceSlider').slider({
            tooltip: 'always',
            formatter: function(value) {
                return value;
            }
        });
        $('#visitSlider').slider({
            tooltip: 'always',
            formatter: function(value) {
                return value;
            }
        });
    </script>
    <script>
        $(function() {
            $('#order').bootstrapToggle({
                on: 'ASC',
                off: 'DSC'
            });
        })
    </script>
@endsection
