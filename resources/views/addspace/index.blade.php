@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo">
                <div class="row">
                    <div class="col-md-8">
                        <h3>
                            {{Lang::get('items.web_or_blog')}}
                        </h3>
                    </div>
                    <div class="col-md-2">
                        @if(Auth::user()->isEditor())
                            <a href="{{route('addspaces.create')}}" class="btn btn-primary create pull-right">{{Lang::get('forms.create')}}</a>
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
            <div class="filtros">
                <h4>Filters: </h4>
                @foreach($categories as $category)
                    <span>
                            <a class="btn btn-info" href="{{route('addspaces.index', ['category' => $category->name])}}">
                                <span>{{$category->name}}</span>
                            </a>
                        </span>
                @endforeach
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
                                    <td>{{Carbon\Carbon::parse($addspace->created_at)}}</td>
                                    <td>
                                        <a data-original-title="Detail" class="btn btn-info" href="{{route('addspaces.show', ['id' => $addspace->id])}}">
                                            {{Lang::get('forms.info')}}
                                        </a>
                                        @if(Auth::id() == $addspace->editor_id || Auth::user()->isManager())
                                            <a data-original-title="Detail" class="btn btn-info" href="{{route('addspaces.edit', ['id' => $addspace->id])}}">
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
