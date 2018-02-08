<!-- Modal -->
<div id="withdrawModal" class="modal fade" role="dialog" style="margin-top: -10%;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{Lang::get('titles.withdrawal')}}</h4>
                <p>{{Lang::get('messages.withdrawal_action')}}</p>
            </div>
            {{Form::open(['route' => 'withdraw'])}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        {{Form::label('paypal', Lang::get('messages.paypal_account'))}}
                        {{Form::text('paypal', Input::old('paypal'), ['class' => 'form-control'])}}
                    </div>
                    <div class="col-md-6 form-group">
                        {{Form::label('amount', Lang::get('messages.amount'))}}
                        {{Form::number('amount', Input::old('amount'), ['class' => 'form-control', 'min' => $withdraw_min, 'max' => $withdraw_max])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        {{Form::label('cbu', Lang::get('messages.cbu'))}}
                        {{Form::text('cbu', Input::old('cbu'), ['class' => 'form-control'])}}
                    </div>
                    <div class="col-md-6 form-group">
                        {{Form::label('alias', Lang::get('messages.alias'))}}
                        {{Form::text('alias', Input::old('alias'), ['class' => 'form-control'])}}

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        {{Form::label('comment', Lang::get('messages.comment'))}}
                        {{Form::textarea('comment', Input::old('comment'), ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('messages.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary pull-left">{{Lang::get('messages.create')}}</button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
        <div class="modal-footer">
            <br>
            <br>
        </div>
    </div>
</div>
