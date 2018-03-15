<?php
use App\Addspace;

$addspace = Addspace::find($addspaceArray['id']);
?>

<div class="col-md-4">
    <div class="row">
        <div class="col-md-12">
            <a href="#">{{$addspace->url}}</a>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                @foreach($addspace->getCategories() as $category)
                    <span class="btn btn-primary disabled">{{$category->name}}</span>
                @endforeach
            </p>
        </div>
        <hr>
    </div>

    <div class="ejemplo-webs">
        <img src="{{asset('img/example.png')}}" class="img-responsive center-block">
        <div class="ejemplo-titular">
            <p>{{Lang::get('items.price').' '.Lang::get('attributes.currency').' '.$addspace->getCost()}}</p>
        </div>
        <div>
            <p><strong>{{Lang::get('items.visits')}}</strong> {{$addspace->visits}} + {{Lang::get('attributes.day_periodicity')}}</p>
            <p><strong>{{Lang::get('items.language')}}</strong> </p>
            <p><strong>{{Lang::get('items.description')}}</strong>
                @if(strlen($addspace->description) > 45)
                    {{substr($addspace->description,0,45).'...'}}
                @else
                    {{substr($addspace->description,0,45)}}
                @endif
            </p>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{'info-'.$addspace->id}}">{{Lang::get('forms.basic.more')}}</button>
            @if(Auth::user()->isAdvertiser())
                <button type="button" class="btn btn-warning"data-toggle="modal" data-target="#{{'charge-'.$addspace->id}}">{{Lang::get('forms.basic.buy')}}</button>
            @else
                    @if(!$addspace->isActive())
                        <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn btn-default">
                            {{Lang::get('forms.addspaces.activate')}}
                        </a>
                    @else
                        <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn btn-warning">
                            {{Lang::get('forms.addspaces.pause')}}
                        </a>
                    @endif
                    @if(!$addspace->isClosed())
                        <a href="{{route('addspaces.close', $addspace->id)}}" class="btn btn-danger">
                            {{Lang::get('forms.addspaces.deactivate')}}
                        </a>
                    @endif
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="{{'info-'.$addspace->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{$addspace->url}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{Form::label('visits', Lang::get('forms.addspaces.item.visits'))}}
                            {{Form::text('visits', $addspace->visits(), ['readonly' => true, 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('language', Lang::get('forms.addspaces.item.language'))}}
                            {{Form::text('language', '', ['readonly' => true, 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('categories', Lang::get('forms.addspaces.item.categories'))}}
                            <p>
                                @foreach($addspace->getCategories() as $category)
                                    <span class="btn btn-primary disabled">{{$category->name}}</span>
                                @endforeach
                            </p>
                        </div>
                        <div class="form-group">
                            {{Form::label('description', Lang::get('forms.addspaces.item.description'))}}
                            {{Form::text('description', $addspace->description, ['readonly' => true, 'class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-info pull-left" href="{{route('addspaces.show', ['id' => $addspace->id])}}">
                                    {{Lang::get('forms.basic.view')}}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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

    </div>
</div>