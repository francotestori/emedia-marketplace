@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <h3>{{Lang::get('titles.packages.create')}}</h3>
        </div>
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
        <br>

        <div class="row panel-heading">
            <div class="col-md-8 col-md-offset-2">
                {{Form::open(['route' => 'package.store'])}}
                <div class="form-group">
                    {{Form::label('name', Lang::get('forms.packages.name'))}}
                    {{Form::text('name', old('name'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('amount', Lang::get('forms.packages.value.emarketplace'))}}
                    <div class="input-group">
                        <span class="input-group-addon" id="amount-addon">USD</span>
                        {{Form::number('amount', old('amount'), ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('cost', Lang::get('forms.packages.value.price'))}}
                    <div class="input-group">
                        <span class="input-group-addon" id="cost-addon">USD</span>
                        {{Form::number('cost', old('cost'), ['class' => 'form-control'])}}
                    </div>
                </div>

                <!--Buttons-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            {{Form::submit(Lang::get('forms.basic.create'), ['class' => 'btn btn-info pull-left'])}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@stop

@section('custom-js')
@endsection
