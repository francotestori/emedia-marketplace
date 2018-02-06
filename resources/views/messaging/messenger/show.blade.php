@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>{{ $thread->subject }}</h4>
                        @if(!$event->pending())
                            <div class="row">
                                <div class="col-lg-12">
                                    <span> {{Lang::get('messages.thread_close')}} <strong>{{$event->state}}</strong></span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        @if(Auth::user()->isAdvertiser() && $event->pending())
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-info pull-left" data-toggle="modal" data-target="#accept">{{Lang::get('messages.accept')}}</button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#reject">{{Lang::get('messages.reject')}}</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    @each('messaging.messenger.partials.messages', $thread->messages, 'message')
                    @if($event->pending())
                        @include('messaging.messenger.partials.form-message')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="reject" class="modal fade" role="dialog">
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
                                    <a class="btn btn-default pull-right" data-dismiss="modal">Cancel</a>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-info pull-left">{{Lang::get('messages.reject')}}</button>
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
    <div id="accept" class="modal fade" role="dialog">
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
                                    <a class="btn btn-default pull-right" data-dismiss="modal">Cancel</a>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-info pull-left">{{Lang::get('messages.accept')}}</button>
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
