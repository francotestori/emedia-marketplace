@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <span>{{Lang::get('items.addspaces')}}</span>
                    </h3>
                </div>
                <div class="col-md-6">
                    @if(Auth::user()->isEditor())
                        <div class="pull-right">
                            <a href="{{route('addspaces.create')}}" class="btn btn-info btn-lg">{{Lang::get('forms.create')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-body">
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
                <div class="col-md-12">
                    <h4>Filters: </h4>
                    @foreach($categories as $category)
                        <span>
                            <a class="btn btn-primary" href="{{route('addspaces.index', ['category' => $category->name])}}">
                                <span>{{$category->name}}</span>
                            </a>
                        </span>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="addspaces-table" @if(count($addspaces)) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>{{Lang::get('attributes.id')}}</th>
                            <th>{{Lang::get('attributes.url')}}</th>
                            <th>{{Lang::get('attributes.cost')}}</th>
                            <th>{{Lang::get('attributes.created_at')}}</th>
                            <th>{{Lang::get('attributes.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($addspaces))
                            @foreach($addspaces as $addspace)
                                <tr>
                                    <td>{{$addspace->id}}</td>
                                    <td><a href="{{$addspace->url}}">{{$addspace->url}}</a></td>
                                    <td>
                                        <strong>{{Lang::get('attributes.currency')}}</strong>
                                        {{$addspace->cost}}
                                    </td>
                                    <td>{{$addspace->created_at}}</td>
                                    <td>
                                        <a data-original-title="Detail" class="btn btn-info" href="{{route('addspaces.show', ['id' => $addspace->id])}}">
                                            <i class="fa fa-info"></i>
                                            {{Lang::get('forms.info')}}
                                        </a>
                                        @if(Auth::id() == $addspace->editor_id || Auth::user()->isManager())
                                            <a data-original-title="Detail" class="btn btn-info" href="{{route('addspaces.edit', ['id' => $addspace->id])}}">
                                                <i class="fa fa-pencil"></i>
                                                {{Lang::get('forms.edit')}}
                                            </a>
                                        @endif
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
