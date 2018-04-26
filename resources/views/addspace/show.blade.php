@extends('layouts.insite-layout')

@section('content')

    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-4">
                    <h1>
                        <a target="_blank" href="{{$addspace->url}}">{{$addspace->url}}</a>
                    </h1>
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
                                    @if(!$addspace->isClosed())
                                        <a href="{{route('addspaces.edit', $addspace->id)}}" class="btn btn-info">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    @endif
                                    @if($addspace->isPaused())
                                        <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn btn-default">
                                            <i class="fa fa-play-circle"></i>
                                        </a>
                                    @elseif($addspace->isActive())
                                        <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn btn-warning">
                                            <i class="fa fa-pause-circle"></i>
                                        </a>
                                    @elseif($addspace->isClosed())
                                        <a class="btn btn-danger" disabled>
                                            {{Lang::get('forms.addspaces.deactivated')}}
                                        </a>
                                    @endif
                                    @if(!$addspace->isClosed())
                                        <a href="{{route('addspaces.close', $addspace->id)}}" class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    @endif
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
                            <span class="btn btn-category disabled">{{'#'.$category->name}}</span>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="panel-heading col-md-6">
                <h3>{{Lang::get('titles.addspaces.detail')}}</h3>
                <p>{{$addspace->description}}</p>
            </div>
            <div class="col-md-1"></div>
            <div class="panel-heading col-md-5">
                <div class="col-md-4">
                    <h3>{{Lang::get('forms.addspaces.item.language')}}</h3>
                    <p>
                    <span>
                        {{Lang::get('attributes.language.'.$addspace->language)}}
                    </span>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>{{Lang::get('attributes.visits')}}</h3>
                        <p>
                            <span>
                                <strong>{{$addspace->visits}}</strong> {{Lang::get('attributes.frequency.'.$addspace->periodicity)}}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>{{Lang::get('forms.addspaces.item.price')}}</h3>
                        <p>
                            @if(!Auth::user()->isAdvertiser())
                                <span class="money-total">
                                    <strong>{{Lang::get('attributes.currency')}}</strong> {{$addspace->cost}}
                                </span>
                            @else
                                <span class="money-total">
                                    <strong>{{Lang::get('attributes.currency')}}</strong> {{$addspace->getCost()}}
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <br>
        @if(!$threads->isEmpty())
            @include('messaging.messenger.partials.flash')
            <div class="panel-heading">
                <br>
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
