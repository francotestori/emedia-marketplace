@extends('layouts.app')

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
                                    <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#transaction">{{Lang::get('messages.buy')}}</button>
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
    <div id="transaction" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction</h4>
                </div>
                <div class="modal-body">
                    <h1>Create a new message</h1>
                    <form action="{{ route('addspaces.charge', $event->id) }}" method="post">
                        {{ csrf_field() }}
                        <!-- Message Form Input -->
                        <p>{{Lang::get('messages.sure')}}</p>
                        <p>{{Lang::get('messages.charge', ['cost' => $event->getAddspace()->cost])}}</p>

                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop
