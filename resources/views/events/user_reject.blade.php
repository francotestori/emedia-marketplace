<div id="{{'reject'.$event->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><span>{{Lang::get('forms.payments.rejecting')}}</span></h3>
            </div>
            {{Form::open(['route' => ['addspaces.user_reject', $event->id]])}}
            <div class="modal-body">
                <p>
                    <span class="alert-danger">{{Lang::get('forms.basic.sure')}}</span>
                </p>
                <div class="form-group">
                    {{Form::label('reason', Lang::get('forms.payments.problem'))}}
                    {{Form::textarea('reason', Input::old('reason'), ['class' => 'form-control', 'rows' => 5])}}
                </div>
            </div>
            <div class="modal-footer">
                <div class="row form-group">
                    <div class="col-lg-6">
                        <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger pull-left">{{Lang::get('forms.payments.reject')}}</button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>