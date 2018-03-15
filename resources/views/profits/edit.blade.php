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
                <h3>{{Lang::get('titles.profits.edit')}}</h3>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    {{Form::open(['route' => 'profits.update'])}}

                    @foreach($profits as $profit)
                        <div class="row">
                            <div class="col-md-4 form-group">
                                {{Form::label('from-'.$profit->id, Lang::get('forms.profits.from').' '.Lang::get('attributes.currency'))}}
                                {{Form::text('from-'.$profit->id, $profit->from_range, ['class' => 'form-control'])}}
                            </div>
                            <div class="col-md-4 form-group">
                                {{Form::label('to-'.$profit->id, Lang::get('forms.profits.to').' '.Lang::get('attributes.currency'))}}
                                {{Form::text('to-'.$profit->id, $profit->to_range, ['class' => 'form-control'])}}
                            </div>
                            <div class="col-md-4 form-group">
                                {{Form::label('value-'.$profit->id, Lang::get('forms.profits.value'))}}
                                {{Form::text('value-'.$profit->id, $profit->value, ['class' => 'form-control'])}}
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-default pull-right" href="{{route('profits.index')}}">{{Lang::get('forms.basic.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info pull-left">{{Lang::get('forms.basic.update')}}</button>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
            <hr>
            <hr>

        </div>
    </div>
@stop

@section('custom-js')
@endsection
