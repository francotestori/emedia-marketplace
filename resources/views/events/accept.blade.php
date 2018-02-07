<div id="{{'accept'.$event->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <span>{{Lang::get('messages.validate_transaction')}}</span>
                    <br>
                    <span>{{Lang::get('messages.remember_score')}}</span>
                </h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('addspaces.accept', $event->id) }}" method="post">
                    {{ csrf_field() }}
                    <!-- Message Form Input -->
                    <p>{{Lang::get('messages.sure')}}</p>

                    <div class="form-group">
                        <label for="score">{{Lang::get('messages.score')}}</label>
                        <input name="score" type="number" step="1" max="10" min="1">
                    </div>

                    <!-- Submit Form Input -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-default pull-right" data-dismiss="modal">{{Lang::get('forms.accept')}}</a>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-info pull-left">{{Lang::get('forms.accept')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>