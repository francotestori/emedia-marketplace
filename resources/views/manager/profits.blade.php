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
                                <td><strong>{{Lang::get('attributes.currency')}}</strong> {{$profit->min}}</td>
                                <td><strong>{{Lang::get('attributes.currency')}}</strong> {{$profit->max}}</td>
                                <td>{{($profit->value * 100).'%'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <a type="button" class="btn btn-info" href="create.html">{{Lang::get('forms.add')}}</a>
            <a type="button" class="btn btn-info" href="edit.html">{{Lang::get('forms.edit')}}</a>
        </div>
    </div>
@stop

@section('custom-js')
@endsection
