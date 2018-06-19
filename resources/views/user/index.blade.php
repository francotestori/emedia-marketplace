<?php
$users_to_show = ($type == null) ? $users : ($type == 'editor' ? $editors : $advertisers)
?>

@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="clearfix">
                <div class="col-md-6 emedia-title">
                    <h1>
                        {{Lang::get('titles.users.index')}}
                    </h1>
                    <p></p>
                </div>
                <div class="col-md-6 emedia-title">
                    @if(Auth::user()->isManager())
                        <a href="{{route('users.create')}}" class="btn btn-block btn-emedia btn-create-user">{{Lang::get('forms.basic.create')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <br>

        <div class="panel-heading table-panel">
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
            <div class="row">
                <div class="col-lg-12">
                    <table class="table editor-users-table" id="addspaces-table" @if(count($users_to_show)) data-ride="datatables" @endif>
                        <thead>
                            <tr>
                                <th>{{Lang::get('tables.users.id')}}</th>
                                <th>{{Lang::get('tables.users.name')}}</th>
                                <th>{{Lang::get('tables.users.email')}}</th>
                                <th>{{Lang::get('tables.users.role')}}</th>
                                <th>{{Lang::get('tables.users.actions')}}</th>
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
                                        <td><!-- <img src="{{asset('img/login-anunciantes.png')}}" -->
                                            <div class="btn-actions-container">
                                                <a class="btn-edit-action" href="{{route('users.edit', ['id' => $user->id])}}">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <a href="{{route('users.password', $user->id)}}" class="password-change">
                                                    <img src="{{asset('img/key1.png')}}" alt="change password">
                                                </a>
                                                <!--<button class="btn btn-warning" data-toggle="modal" data-target="{{'#password'.$user->id}}">{{Lang::get('forms.users.send')}}</button>-->
                                                <a href="{{'#password'.$user->id}}" data-toggle="modal" class="password-send">
                                                    <img src="{{asset('img/key2.png')}}" alt="send password">
                                                </a>
                                                @if($user->activated)
                                                    <a class="btn-close-action" href="{{route('users.deactivate',[$user->id])}}">
                                                        <i class="fa fa-times-circle"></i>
                                                    </a>
                                                @else
                                                    <a class="btn-play-action" href="{{route('users.activate',[$user->id])}}">
                                                        <i class="fa fa-play-circle"></i>
                                                    </a>
                                                @endif                                                
                                            </div>
                                        </td>
                                        <!-- Modal de enviar password -->
                                        <div class="modal fade" id="{{'password'.$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3>{{Lang::get('forms.users.sending')}}</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    {{Form::open(['route' => ['users.sendpassword', $user->id]])}}
                                                        <div class="modal-footer">
                                                            <div class="row form-group">
                                                                <div class="col-md-6">
                                                                    <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-info pull-left">{{Lang::get('forms.users.send')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{Form::close()}}
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
            var oTable = $(this).dataTable(
                {
                    "language": {
                        "paginate": {
                            "previous": "{{Lang::get('tables.previous')}}",
                            "next": "{{Lang::get('tables.next')}}",
                            "first": "{{Lang::get('tables.first')}}",
                            "last": "{{Lang::get('tables.last')}}"
                        },
                        "emptyTables": "{{Lang::get('tables.empty')}}",
                        "lengthMenu": "{{Lang::get('tables.lengthMenu')}}",
                        "info": "{{Lang::get('tables.info')}}",
                        "search": "{{Lang::get('tables.search')}}"
                    }
                }
            );
        });
    </script>
@endsection
