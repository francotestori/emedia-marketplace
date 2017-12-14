@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>
                                    <span>Addspaces</span>
                                </h3>
                            </div>
                            <div class="col-lg-6">
                                @if(Auth::user()->isEditor())
                                    <div class="pull-right">
                                        <a href="{{route('addspaces.create')}}" class="btn btn-info btn-lg">{{Lang::get('messages.create')}}</a>
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
                                <div class="col-lg-12">
                                    <h4>Filters: </h4>
                                    @foreach($categories as $category)
                                        <a href="{{route('addspaces.index', ['category' => $category->name])}}"><span class="label label-primary">{{$category->name}}</span></a>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul>
                                        @foreach($addspaces as $addspace)
                                            <li>
                                                <h5>
                                                    <span>
                                                        {{'#'.$addspace->id}} -<a href="{{route('addspaces.show',$addspace->id)}}">{{'Check it at: '.$addspace->url}}</a>
                                                    </span>
                                                </h5>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
