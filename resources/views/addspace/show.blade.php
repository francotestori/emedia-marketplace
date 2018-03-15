@extends('layouts.insite-layout')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4">
                    <h3>
                        <span>
                            <strong>{{Lang::get('titles.addspaces.web')}}</strong>
                            <a href="{{$addspace->url}}">{{$addspace->url}}</a>
                        </span>
                    </h3>
                </div>

                <div class="col-md-8">
                    <div class="pull-right balance">
                        @if(Auth::user()->isAdvertiser() && count($events) == 0)
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{'charge-'.$addspace->id}}">
                                <span>
                                    <i class="fa fa-shopping-cart"></i>
                                    {{Lang::get('forms.basic.buy')}}
                                </span>
                            </button>
                        @elseif(!Auth::user()->isAdvertiser())
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!$addspace->isActive())
                                        <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn btn-default">
                                            <i class="fa fa-play-circle"></i>
                                            {{Lang::get('forms.addspaces.activate')}}
                                        </a>
                                    @else
                                        <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn btn-warning">
                                            <i class="fa fa-pause-circle"></i>
                                            {{Lang::get('forms.addspaces.pause')}}
                                        </a>
                                    @endif
                                    @if(!$addspace->isClosed())
                                        <a href="{{route('addspaces.close', $addspace->id)}}" class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                            {{Lang::get('forms.addspaces.deactivate')}}
                                        </a>
                                    @endif
                                        <a href="{{route('addspaces.edit', $addspace->id)}}" class="btn btn-info">
                                            <i class="fa fa-pencil"></i>
                                            {{Lang::get('forms.basic.edit')}}
                                        </a>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        @foreach($addspace->getCategories() as $category)
                            <span class="btn btn-primary disabled">{{$category->name}}</span>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-titulo2">
            <h3>{{Lang::get('titles.addspaces.detail')}}</h3>
        </div>
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
                <p><strong>{{Lang::get('forms.addspaces.item.description')}}: </strong>{{$addspace->description}}</p>
                <p><strong>{{Lang::get('attributes.visits')}}: </strong>{{$addspace->visits}} {{Lang::get('forms.addspaces.item.frequency')}}</p>
            @if(!Auth::user()->isAdvertiser())
                <p><strong>{{Lang::get('forms.addspaces.item.price')}}: </strong>{{Lang::get('attributes.currency')}} {{$addspace->cost}}</p>
            @else
                <p><strong>{{Lang::get('forms.addspaces.item.price')}}: </strong>{{Lang::get('attributes.currency')}} {{$addspace->getCost()}}</p>
            @endif

        </div>
        <br>
        @if(!$threads->isEmpty())
            @include('messaging.messenger.partials.flash')
            <div class="panel-heading">
                @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')
            </div>
        @endif
    </div>

    <div id="{{'charge-'.$addspace->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content  alert-info">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">{{Lang::get('forms.addspaces.sure')}}</h3>
                </div>
                <div class="modal-body formulario">
                    <p>
                        {{Lang::get('forms.addspaces.charging',
                                    ['amount' => Lang::get('attributes.currency').' '.$addspace->getCost()])}}
                    </p>
                </div>

                {{Form::open(['route' => ['addspaces.charge', $addspace->id]])}}
                <input type="hidden" name="subject" value="{{Lang::get('messages.query', ['user' => Auth::user()->name, 'url' => $addspace->url])}}">
                <input type="hidden" name="recipient" value="{{$addspace->getEditor()->id}}">
                <input type="hidden" name="reference" value="{{$addspace->id}}">
                <div class="modal-footer">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning pull-left">{{Lang::get('forms.basic.buy')}}</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>

        </div>
    </div>

@endsection
