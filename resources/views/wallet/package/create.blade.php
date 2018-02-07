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
                <h3>{{Lang::get('messages.packages')}}</h3>
            </div>
            <br>
            {{Form::open(['route' => 'package.store'])}}
            <div class="form-group">
                {{Form::label('name', Lang::get('forms.name'))}}
                {{Form::text('name', old('name'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('amount', Lang::get('forms.amount'))}}
                {{Form::number('amount', old('amount'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('cost', Lang::get('forms.cost'))}}
                {{Form::number('cost', old('cost'), ['class' => 'form-control'])}}
            </div>
            <!--Buttons-->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        {{Form::submit(Lang::get('forms.create'), ['class' => 'btn btn-info pull-left'])}}
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop

@section('custom-js')
@endsection
