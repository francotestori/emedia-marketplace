<?php
use App\Addspace;

$addspace = Addspace::find($addspaceArray['id']);
?>

<div class="col-md-4">
    <div class="advertiser-web-result">
        <div class="box-title">            
            <a target="_blank" class="ejemplo-titular" href="{{$addspace->url}}">
                {{substr(str_replace_first('www.','',str_replace_first('http://', '', $addspace->url)),0,35)}}
            </a>
        </div>        
        <div class="web-result-info">
            <p class="web-caegories">
                @if(count($addspace->getCategories()))
                    @foreach($addspace->getCategories() as $category)
                        <span class="category-tag disabled">{{$category->name}}</span>
                    @endforeach
                @else
                    <span class="btn btn-default disabled">{{Lang::get('attributes.categories.empty')}}</span>
                @endif
            </p>
            <h4 class="web-result-price">
                <strong>{{Lang::get('items.price')}} <span class="money-total"> {{Lang::get('attributes.currency').' '.$addspace->getCost()}}</span></strong>
            </h4>
            <p>{{Lang::get('items.visits')}} <strong>+{{$addspace->monthlyVisits()}} {{Lang::get('attributes.frequency.month')}}</strong></p>
            <p>{{Lang::get('items.language')}} <strong>{{Lang::get('attributes.language.'.$addspace->language)}}</strong></p>
            <p>{{Lang::get('items.description')}}
                <strong>
                @if(strlen($addspace->description) > 60)
                    {{substr($addspace->description,0,60).'...'}}
                @else
                    {{substr($addspace->description,0,60)}}
                @endif
                </strong>
            </p>            
        </div>
        <?php (Auth::user()->isAdvertiser()) ? $class="" : $class = "admin-actions"  ?>
        <div class="web-result-actions {{$class}}">
            <a href="{{route('addspaces.show',[$addspace->id])}}" class="btn-info-action"><i class="fa fa-info-circle"></i></a>
{{--            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{'info-'.$addspace->id}}">{{Lang::get('forms.basic.more')}}</button>--}}
            @if(Auth::user()->isAdvertiser())
                <button type="button" class="btn btn-simple-emedia"data-toggle="modal" data-target="#{{'charge-'.$addspace->id}}">{{Lang::get('forms.basic.buy')}}</button>
            @else
                @if(!$addspace->isActive())
                    <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn-play-action">
                        <i class="fa fa-play-circle"></i>
                    </a>
                @else
                    <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn-pause-action">
                        <i class="fa fa-pause-circle"></i>
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
                            {{Form::textarea('description', $addspace->description, ['readonly' => true, 'class' => 'form-control'])}}
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