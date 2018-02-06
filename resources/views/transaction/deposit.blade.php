@extends('layouts.insite-layout')

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
                <h3>{{Lang::get('titles.deposit')}}</h3>
            </div>
            <br>
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
    </div>
@endsection