<div id="{{'reject'.$event->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{Lang::get('messages.rollback_transaction')}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('addspaces.reject', $event->id) }}" method="post">
                    {{ csrf_field() }}
                    <!-- Message Form Input -->
                    <p>{{Lang::get('messages.sure')}}</p>
                    <div class="form-group">
                        <label for="reason">{{Lang::get('messages.describe_problem')}}</label>
                        <textarea class="form-control" rows="5" name="reason" id="reason"></textarea>
                    </div>
                    <!-- Submit Form Input -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.cancel')}}</a>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-info pull-left">{{Lang::get('forms.reject')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
