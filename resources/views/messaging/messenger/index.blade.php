@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        @include('messaging.messenger.partials.flash')

        <div class="panel-heading">
            @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')
        </div>
    </div>
@stop
