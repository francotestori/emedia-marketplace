@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="clearfix">
                <div class="col-md-8 emedia-title">
                    <h1 class="heading">{{Lang::get('titles.addspaces.web')}}</h1>
                    <p class="subheading">{{Lang::get('messages.addspaces.tuft')}}</p>
                </div>
                <div class="col-md-4 emedia-title">
                    @if(Auth::user()->isEditor())
                        <a href="{{route('addspaces.create')}}" class="btn btn-block btn-emedia pull-right">{{Lang::get('forms.basic.create')}}</a>
                    @endif
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
        <div class="panel-heading">
            @include('addspace.filter', ['selected_categories' => $selected_categories])
        </div>
        <br>
        <div class="panel-heading table-panel">
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="addspaces-table" @if(count($addspaces)) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>{{Lang::get('tables.addspaces.id')}}</th>
                            <th>{{Lang::get('tables.addspaces.url')}}</th>
                            <th>{{Lang::get('tables.addspaces.cost')}}</th>
                            <th>{{Lang::get('tables.addspaces.created_at')}}</th>
                            <th>{{Lang::get('tables.addspaces.status')}}</th>
                            <th>{{Lang::get('tables.addspaces.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($addspaces))
                            @foreach($addspaces as $addspace)
                                <tr>
                                    <td>{{$addspace->id}}</td>
                                    <td><a target="_blank" href="{{$addspace->url}}">{{$addspace->url}}</a></td>
                                    <td>
                                        <strong>{{Lang::get('attributes.currency')}}</strong>
                                        {{$addspace->cost}}
                                    </td>
                                    <td>{{Carbon\Carbon::parse($addspace->created_at)}}</td>
                                    <td class="col-state-my-webs">
                                        <?php
                                        switch($addspace->status)
                                        {
                                            case 'ACTIVE':
                                                $class = "btn-success btn-table-border";
                                                break;
                                            case 'PAUSED':
                                                $class = "btn-warning btn-table-border";
                                                break;
                                            default:
                                                $class = "btn-danger btn-table-border";
                                                break;
                                        }
                                        ?>
                                        <span class="btn btn-block {{$class}}">{{Lang::get('attributes.'.$addspace->status)}}</span>
                                    </td>
                                    <td>
                                        <div class="btn-actions-container">
                                            <a class="btn-info-action"
                                               href="{{route('addspaces.show', ['id' => $addspace->id])}}">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                            @if((Auth::id() == $addspace->editor_id || Auth::user()->isManager()) && !$addspace->isClosed())
                                                <a data-original-title="Detail" class="btn-edit-action"
                                                   href="{{route('addspaces.edit', ['id' => $addspace->id])}}">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                @if($addspace->isPaused())
                                                    <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn-play-action">
                                                        <i class="fa fa-play-circle"></i>
                                                    </a>
                                                @elseif($addspace->isActive())
                                                    <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn-pause-action">
                                                        <i class="fa fa-pause-circle"></i>
                                                    </a>
                                                @endif
                                            @endif
                                            @if(!$addspace->isClosed())
                                                <button type="button" class="btn-close-action" data-toggle="modal" data-target="#closeAddspace{{$addspace->id}}">
                                                    <i class="fa fa-times-circle"></i>
                                                </button>
                                                <div id="closeAddspace{{$addspace->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content deactivate-web">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3>
                                                                    {{Lang::get('messages.addspaces.deactivate')}}
                                                                    <strong>{{$addspace->url}}</strong>
                                                                </h3>
                                                                <h3>{{Lang::get('messages.addspaces.confirm')}}</h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-default" data-dismiss="modal">
                                                                    {{Lang::get('forms.basic.cancel')}}
                                                                </button>
                                                                <a href="{{route('addspaces.close', $addspace->id)}}" class="btn btn-danger">
                                                                    {{Lang::get('forms.basic.close')}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{Lang::get('messages.no_items_found')}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <!--
            <div class="row status-bar">
                <div class="col-sm-4">
                    <span class="label label-success" data-toggle="tooltip" data-placement="bottom" data-original-title="{{Lang::get('tables.active')}}">{{Lang::get('tables.active')}}</span>
                </div>
                <div class="col-sm-4">
                    <span class="label label-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="{{Lang::get('tables.paused')}}">{{Lang::get('tables.paused')}}</span>
                </div>
                <div class="col-sm-4">
                    <span class="label label-danger" data-toggle="tooltip" data-placement="bottom" data-original-title="{{Lang::get('tables.closed')}}">{{Lang::get('tables.closed')}}</span>
                </div>
            </div>
            -->
        </div>
    </div>

@endsection

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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