@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Threads</div>
                    <div class="panel-body">
                        @include('messaging.messenger.partials.flash')
                        @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
