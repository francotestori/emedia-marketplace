<?php
$users_to_show = ($type == null) ? $users : ($type == 'editor' ? $editors : $advertisers)
?>

@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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
                <div class="row">
                    <div class="col-md-6">
                        <h3>
                            {{Lang::get('titles.users')}}
                        </h3>
                    </div>
                    <div class="col-md-6">
                        @if(Auth::user()->isManager())
                            <div class="pull-right">
                                <a href="{{route('users.create')}}" class="btn btn-info btn-lg">{{Lang::get('messages.create_users')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered" id="addspaces-table" @if(count($users_to_show)) data-ride="datatables" @endif>
                        <thead>
                            <tr>
                                <th>{{Lang::get('attributes.id')}}</th>
                                <th>{{Lang::get('attributes.name')}}</th>
                                <th>{{Lang::get('attributes.email')}}</th>
                                <th>{{Lang::get('attributes.role')}}</th>
                                <th>{{Lang::get('attributes.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users_to_show))
                                @foreach($users_to_show as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->getRole()}}</td>
                                        <td class="">
                                            <a type="button" class="btn btn-info" href="{{route('users.edit', ['id' => $user->id])}}">{{Lang::get('messages.edit')}}</a>
                                            <a type="button" class="btn btn-danger" href="#">{{Lang::get('forms.deactivate')}}</a>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="{{'#password'.$user->id}}">{{Lang::get('forms.send_password')}}</button>
                                        </td>
                                        <!-- Modal de enviar password -->
                                        <div class="modal fade" id="{{'password'.$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                        {{Lang::get('messages.wish_password')}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('forms.close')}}</button>
                                                        <button type="button" class="btn btn-primary">{{Lang::get('forms.send')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No Companies Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        // datatable
        $('[data-ride="datatables"]').each(function() {
            var oTable = $(this).dataTable();
        });
    </script>
@endsection
