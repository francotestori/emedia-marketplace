@extends('layouts.insite-layout')

@section('content')

    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-8 emedia-title">
                    <div class="breadcrumbs">
                        <a href="{{route('addspaces.index')}}"> Mis Webs </a> / {{$addspace->url}}
                    </div>
                    <h1 class="web-name">
                        <a target="_blank" href="{{$addspace->url}}">{{$addspace->url}}</a>
                    </h1>
                </div>

                <div class="col-md-4 emedia-title">
                    <div class="pull-right balance">
                        @if(Auth::user()->isAdvertiser() && count($events) == 0)
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{'charge-'.$addspace->id}}">
                                <span>
                                    <i class="fa fa-shopping-cart"></i>
                                    {{Lang::get('forms.basic.buy')}}
                                </span>
                            </button>
                        @elseif(!Auth::user()->isAdvertiser())
                            <div class="row btn-actions-container-lg">
                                <div class="col-md-12">
                                    @if(!$addspace->isClosed())
                                        <a href="{{route('addspaces.edit', $addspace->id)}}" class="btn-edit-action">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    @endif
                                    @if($addspace->isPaused())
                                        <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn-play-action">
                                            <i class="fa fa-play-circle"></i>
                                        </a>
                                    @elseif($addspace->isActive())
                                        <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn-pause-action">
                                            <i class="fa fa-pause-circle"></i>
                                        </a>
                                    @elseif($addspace->isClosed())
                                        <a class="btn btn-danger" disabled>
                                            {{Lang::get('forms.addspaces.deactivated')}}
                                        </a>
                                    @endif
                                    @if(!$addspace->isClosed())
                                        <a href="" class="btn-close-action" data-toggle="modal" data-target="#closeAddspace{{$addspace->id}}">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
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
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row category-row">
                <div class="col-md-12">
                    <h3>
                        @foreach($addspace->getCategories() as $category)
                            <span class="category-tag disabled">{{'#'.$category->name}}</span>
                        @endforeach
                    </h3>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="panel-heading col-md-7 web-info-box details-box">
                <h3>{{Lang::get('titles.addspaces.detail')}}</h3>
                <p>{{$addspace->description}}</p>
            </div>
            <div class="panel-heading col-md-5 web-info-box views-price-box">
                <!-- <div class="col-md-4">
                    <h3>{{Lang::get('forms.addspaces.item.language')}}</h3>
                    <p>
                    <span>
                        {{Lang::get('attributes.language.'.$addspace->language)}}
                    </span>
                    </p>
                </div> -->
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{Lang::get('attributes.visits')}}</h3>
                        <p>
                            <span>
                                <strong>{{$addspace->visits}}</strong> {{Lang::get('attributes.frequency.'.$addspace->periodicity)}}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
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
            <div class="panel-heading web-info-msjs">
                <br>
                @include('messaging.messenger.partials.flash')
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
