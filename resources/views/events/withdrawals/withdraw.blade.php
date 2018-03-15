<div id="{{'withdraw-'.$withdrawal->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><span>{{Lang::get('forms.withdrawals.authorizing')}}</span></h3>
            </div>
            {{Form::open(['route' => ['withdrawal.authorize', $withdrawal->id]])}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {{Form::label('requester', Lang::get('forms.withdrawals.requester'))}}
                            {{Form::text('requester', $withdrawal->getSender()->getUser()->email, ['class' => 'form-control', 'readonly' => true])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('amount', Lang::get('forms.withdrawals.amount').' '.Lang::get('attributes.currency'))}}
                            {{Form::text('amount', $withdrawal->amount, ['class' => 'form-control', 'readonly' => true])}}
                        </div>
                    </div>
                </div>
                <p>{{Lang::get('forms.withdrawals.sure')}}</p>
                <div class="form-group">
                    {{Form::label('state', Lang::get('forms.withdrawals.action'))}}
                    {{Form::select('state', ['ACCEPTED' => 'ACCEPT','REJECTED' => 'REJECT',], 'ACCEPTED', ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="modal-footer">
                <div class="row form-group">
                    <div class="col-lg-6">
                        <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-warning pull-left">{{Lang::get('forms.basic.apply')}}</button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>