@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <span>Config</span>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @foreach($config as $item)
                                <div class="col-lg-6">
                                    {{Form::label('key', Lang::get('messages.key'))}}
                                    {{Form::text('key', $item->configuration_key, ['class' => 'form-control', 'readonly' => 'true'])}}
                                </div>
                                <div class="col-lg-6">
                                    {{Form::label('value', Lang::get('messages.value'))}}
                                    {{Form::text('value', $item->configuration_value.' %', ['class' => 'form-control','readonly' => 'true'])}}
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
