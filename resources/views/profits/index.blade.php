@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12 emedia-title">
                    <h1>{{Lang::get('titles.profits.index')}}</h1>
                </div>
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

        <br>

        <div class="panel-heading table-panel profits-table">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{Lang::get('tables.profits.from')}}</th>
                        <th>{{Lang::get('tables.profits.to')}}</th>
                        <th>{{Lang::get('tables.profits.value')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profits as $profit)
                        <tr>
                            <td><strong>{{Lang::get('attributes.currency')}}</strong> {{$profit->from_range}}</td>
                            <td><strong>{{Lang::get('attributes.currency')}}</strong> {{$profit->to_range}}</td>
                            <td>{{$profit->value.'%'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="profit-table-btns clearfix">
                <button type="button" class="btn btn-simple-emedia pull-right" data-toggle="modal" data-target="#add-profit">{{Lang::get('forms.basic.add')}}</button>
                <a class="pull-right" href="{{route('profits.edit')}}">{{Lang::get('forms.basic.edit')}}</a>
            </div>
        </div>
        <div class="profit-webs">
        @each('profits.group', $clusters, 'addspaces')
        </div>
        <!-- Modal -->
            <div class="modal fade" id="add-profit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{Lang::get('forms.profits.creating')}}</h4>
                        </div>
                        {{Form::open(['route' => 'profits.store'])}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        {{Form::label('from', Lang::get('forms.profits.from'))}}
                                        <div class="input-group">
                                            <span class="input-group-addon" id="from-addon">USD</span>
                                            {{Form::number('from', old('from'), ['class' => 'form-control','step'=>'1', 'min' => 0])}}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {{Form::label('to', Lang::get('forms.profits.to'))}}
                                        <div class="input-group">
                                            <span class="input-group-addon" id="to-addon">USD</span>
                                            {{Form::number('to', old('to'), ['class' => 'form-control','step'=>'1', 'min' => 0])}}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        {{Form::label('profit', Lang::get('forms.profits.value'))}}
                                        <div class="input-group">
                                            <span class="input-group-addon" id="profit-addon">%</span>
                                            {{Form::number('profit', old('profit'), ['class' => 'form-control','step'=>'1', 'min' => 0, 'max' => 100])}}
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info pull-left">{{Lang::get('forms.basic.create')}}</button>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>        
    </div>
@stop

@section('custom-js')
@endsection
