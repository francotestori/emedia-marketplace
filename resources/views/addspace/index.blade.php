@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Addspaces</span>
                            </div>
                            <div class="col-lg-6">
                                @if(Auth::user()->isEditor())
                                <div class="pull-right">
                                    <a href="{{route('addspaces.create')}}" class="btn btn-info">{{Lang::get('messages.create')}}</a>
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

                        <div class="row">
                            <div class="col-lg-12">
                                <ul>
                                @foreach($addspaces as $addspace)
                                <li>
                                    <span>
                                        {{$addspace->id}} -<a href="{{route('addspaces.show',$addspace->id)}}">Addspace - {{$addspace->url}}</a>
                                    </span>

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
