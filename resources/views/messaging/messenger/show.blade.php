@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>{{ $thread->subject }}</h4>
                            </div>
                            <div class="col-lg-6">
                                @if(Auth::user()->isAdvertiser())
                                    <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#rollback">{{Lang::get('messages.rollback')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @each('messaging.messenger.partials.messages', $thread->messages, 'message')
                                @include('messaging.messenger.partials.form-message')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="rollback" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Do you want to rollback this transaction?</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addspaces.rollback', $event->id) }}" method="post">
                        {{ csrf_field() }}
                        <!-- Message Form Input -->
                        <p>{{Lang::get('messages.sure')}}</p>

                        <div class="form-group">
                            <label for="reason">Describe your problem:</label>
                            <textarea class="form-control" rows="5" name="reason" id="reason"></textarea>
                        </div>

                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="btn btn-default pull-right" data-dismiss="modal">Cancel</a>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-info pull-left">{{Lang::get('messages.rollback')}}</button>
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
@stop
