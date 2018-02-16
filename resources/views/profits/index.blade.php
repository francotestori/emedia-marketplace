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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Precio desde</th>
                        <th>Precio hasta</th>
                        <th>Profit</th>
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
            <hr>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-profit">{{Lang::get('forms.add')}}</button>
            <a class="btn btn-info" href="#">{{Lang::get('forms.edit')}}</a>
            <hr>
            @each('profits.group', $clusters, 'addspaces')

                <!-- Modal -->
                <div class="modal fade" id="add-profit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">{{Lang::get('messages.add_profit')}}</h4>
                            </div>
                            {{Form::open(['route' => 'profits.store', 'class' => 'formulario'])}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group">
                                        {{Form::label('from', Lang::get('forms.from'))}}
                                        {{Form::number('from', old('from'), ['class' => 'form-control','step'=>'1', 'min' => 0])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('to', Lang::get('forms.to'))}}
                                        {{Form::number('to', old('to'), ['class' => 'form-control','step'=>'1', 'min' => 0])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('profit', Lang::get('forms.profit'))}}
                                        {{Form::number('profit', old('profit'), ['class' => 'form-control','step'=>'1', 'min' => 0, 'max' => 100])}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">{{Lang::get('forms.close')}}</a>
                                <button class="btn btn-info">{{Lang::get('forms.add')}}</button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>

        </div>
    </div>
@stop

@section('custom-js')
@endsection
