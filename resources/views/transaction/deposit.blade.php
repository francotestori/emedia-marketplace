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
                <h3>{{Lang::get('titles.wallet.deposit')}}</h3>
            </div>
            <br>
            {{Form::open(['route' => 'deposit.prepare'])}}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 form-group">
                        {{Form::label('amount', Lang::get('forms.transactions.deposit.amount'))}}
                        {{Form::number('amount', null, ['class' => 'form-control','step'=>'any'])}}
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info pull-left">{{Lang::get('forms.basic.apply')}}</button>
                    </div>
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection