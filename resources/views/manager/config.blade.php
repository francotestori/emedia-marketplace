@extends('layouts.insite-layout')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        {{Lang::get('titles.config')}}
                    </h3>
                </div>
                <div class="col-md-6">
                </div>
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
            <div class="row atencion">
                @foreach($config as $item)
                    <div class="col-md-4">
                        {{Form::label('key', Lang::get('messages.key'))}}
                        {{Form::text('key', $item->key, ['class' => 'form-control', 'readonly' => 'true'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('min', Lang::get('messages.min'))}}
                        {{Form::text('min', $item->min, ['class' => 'form-control','readonly' => 'true'])}}
                    </div>
                    <div class="col-md-4">
                        {{Form::label('max', Lang::get('messages.max'))}}
                        {{Form::text('max', $item->max, ['class' => 'form-control','readonly' => 'true'])}}
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
