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
            <p><strong>{{Lang::get('items.description')}}</strong> {{$addspace->description}}</p>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{'info-'.$addspace->id}}">{{Lang::get('messages.more')}}</button>
            @if(Auth::user()->isAdvertiser())
                <button type="button" class="btn btn-warning"data-toggle="modal" data-target="#{{'charge-'.$addspace->id}}">{{Lang::get('forms.buy')}}</button>
            @else
                    @if(!$addspace->isActive())
                        <a href="{{route('addspaces.activate', $addspace->id)}}" class="btn btn-default">
                            {{Lang::get('forms.activate')}}
                        </a>
                    @else
                        <a href="{{route('addspaces.pause', $addspace->id)}}" class="btn btn-warning">
                            {{Lang::get('forms.pause')}}
                        </a>
                    @endif
                    @if(!$addspace->isClosed())
                        <a href="{{route('addspaces.close', $addspace->id)}}" class="btn btn-danger">
                            {{Lang::get('forms.deactivate')}}
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
                        <p><strong>{{Lang::get('items.visits')}}</strong> {{$addspace->visits}} + por día</p>
                        <p><strong>{{Lang::get('items.language')}}</strong> </p>
                        <p><strong>{{Lang::get('items.categories')}}</strong>
                            @foreach($addspace->getCategories() as $category)
                                <span class="btn btn-primary disabled">{{$category->name}}</span>
                            @endforeach
                        </p>
                        <p><strong>{{Lang::get('items.description')}}</strong> {{$addspace->description}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('forms.close')}}</button>
                        <a data-original-title="Detail" class="btn btn-info" href="{{route('addspaces.show', ['id' => $addspace->id])}}">
                            {{Lang::get('forms.addspace')}}
                        </a>
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
                        <h4 class="modal-title">{{Lang::get('messages.are_you_sure_buy')}}</h4>
                    </div>
                    <div class="modal-body formulario">
                        <p>{{Lang::get('messages.charge', ['amount' => Lang::get('attributes.currency').$addspace->getCost()])}}</p>

                        <form action="{{ route('addspaces.charge',['id' => $addspace->id]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="subject" value="{{Lang::get('messages.query', ['user' => Auth::user()->name, 'url' => $addspace->url])}}">
                            <input type="hidden" name="recipient" value="{{$addspace->getEditor()->id}}">
                            <input type="hidden" name="reference" value="{{$addspace->id}}">

                            <!-- Submit Form Input -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn btn-danger pull-right" data-dismiss="modal">{{Lang::get('forms.cancel')}}</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-info pull-left">{{Lang::get('forms.buy')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>