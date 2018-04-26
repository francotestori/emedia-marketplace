<?php
use App\Addspace;

$addspace = Addspace::find($addspaceArray['id']);
?>

<div class="col-md-4">
    <div class="ejemplo-webs">
        <img src="{{asset('img/example.png')}}" class="img-responsive center-block">

        <div class="row">
            <div class="col-md-12">
                <a target="_blank" class="ejemplo-titular" href="{{$addspace->url}}">
                    {{substr(str_replace_first('www.','',str_replace_first('http://', '', $addspace->url)),0,27)}}
                </a>
            </div>
        </div>

        <div>
            <p><strong>{{Lang::get('items.visits')}}</strong> {{$addspace->visits}} + {{Lang::get('attributes.frequency.'.$addspace->periodicity)}}</p>
            <p><strong>{{Lang::get('items.language')}}</strong> {{Lang::get('attributes.language.'.$addspace->language)}}</p>
            <p><strong>{{Lang::get('items.description')}}</strong>
                @if(strlen($addspace->description) > 30)
                    {{substr($addspace->description,0,30).'...'}}
                @else
                    {{substr($addspace->description,0,30)}}
                @endif
            </p>
            <h4>
                <strong>{{Lang::get('items.price').' '.Lang::get('attributes.currency').' '.$addspace->getCost()}}</strong>
            </h4>
            <p class="profit"><strong>{{Lang::get('items.profit').': '}}</strong>{{$addspace->profit}}<strong>%</strong></p>
            <p class="profit"><strong>{{Lang::get('items.revenue').': '}}</strong>{{Lang::get('attributes.currency').$addspace->getSystemRevenue()}}</p>
            <div class="btn-group">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{'change-'.$addspace->id}}">{{Lang::get('forms.profits.change')}}</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{'default-'.$addspace->id}}">{{Lang::get('forms.profits.apply')}}</button>
            </div>
        </div>

        <!-- Modals -->
        <div class="modal fade" id="{{'change-'.$addspace->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{$addspace->url}}</h4>
                    </div>
                    {{Form::open(['route' => ['profits.change', $addspace->id], 'class' => 'formulario'])}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 form-group">
                                {{Form::label('profit', Lang::get('forms.profits.value'))}}
                                {{Form::number('profit', $addspace->profit, ['class' => 'form-control','step'=>'1', 'min' => 0, 'max' => 100])}}
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info pull-left">{{Lang::get('forms.basic.change')}}</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>

        <div id="{{'default-'.$addspace->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content  alert-info">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{Lang::get('forms.profits.system')}}</h4>
                    </div>
                    {{Form::open(['route' => ['profits.default', $addspace->id]])}}
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info pull-left">{{Lang::get('forms.basic.apply')}}</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>

            </div>
        </div>

    </div>
</div>