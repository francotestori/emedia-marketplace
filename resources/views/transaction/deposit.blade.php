@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (Session::has('message'))
                    <div class="alert alert-{{ Session::get('code') }}">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Deposit</div>
                    <div class="panel-body">
                        {{Form::open(['route' => 'deposit.prepare'])}}
                        <div class="form-group">
                            {{Form::label('price', Lang::get('messages.price'))}}
                            {{Form::number('price', null, ['class' => 'form-control','step'=>'any'])}}
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <!--Buttons-->
                                <div class="form-group">
                                    <a href="{{URL::previous()}}" class="btn btn-def">{{Lang::get('messages.cancel')}}</a>
                                    {{Form::submit(Lang::get('messages.deposit'), ['class' => 'btn btn-primary'])}}
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection