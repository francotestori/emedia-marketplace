<div id="{{'accept'.$event->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><span>{{Lang::get('forms.payments.accepting')}}</span></h3>
                <h5 class="modal-title"><span>{{Lang::get('forms.payments.scoring')}}</span></h5>
            </div>
            {{Form::open(['route' => ['addspaces.accept', $event->id]])}}
            <div class="modal-body">
                <p>
                    <span class="alert-warning">{{Lang::get('forms.basic.sure')}}</span>
                </p>
                <div class="form-group">
                    {{Form::label('score', Lang::get('forms.payments.score'))}}
                    <span id="myRating" class="rating" data-stars="10"></span>
                    <input type="hidden" name="score" id="score">
                </div>
            </div>
            <div class="modal-footer">
                <div class="row form-group">
                    <div class="col-lg-6">
                        <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success pull-left">{{Lang::get('forms.payments.accept')}}</button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>