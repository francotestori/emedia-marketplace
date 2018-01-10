@extends('layouts.insite-layout')

@section('content')

    <div class="panel panel-default">
        @if (Session::has('message'))
        <div class="panel-heading">
            <div class="alert alert-{{ Session::get('code') }}">
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>
        @endif

        <div class="detalles-texto">
            {{Lang::get('titles.deposit')}}
        </div>

        <div class="detalles">
            {{Form::open(['route' => 'deposit.prepare'])}}
            <div class="form-group">
                {{Form::label('Amount', Lang::get('messages.amount'))}}
                {{Form::number('amount', null, ['class' => 'form-control','step'=>'any'])}}
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <!--Buttons-->
                    <div class="form-group">
                        <a href="{{URL::previous()}}" class="btn btn-def">{{Lang::get('messages.cancel')}}</a>
                        {{Form::submit(Lang::get('messages.deposit'), ['class' => 'btn btn-primary'])}}
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection