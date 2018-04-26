@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        @include('messaging.messenger.partials.flash')

        <div class="panel-heading">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')
        </div>
    </div>
@stop
