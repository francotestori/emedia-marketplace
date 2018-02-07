@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-10">
                        <h4>{{ $thread->subject }}</h4>
                        @if(!$event->pending())
                            <span> {{Lang::get('messages.thread_close')}} <strong>{{$event->state}}</strong></span>
                        @endif
                    </div>
                    <div class="col-md-2 pull-right">
                        @if(Auth::user()->isAdvertiser() && $event->pending())
                            <button class="btn btn-danger" data-toggle="modal" data-target="{{'#reject'.$event->id}}">{{Lang::get('forms.reject')}}</button>
                            <button class="btn btn-success" data-toggle="modal" data-target="{{'#accept'.$event->id}}">{{Lang::get('forms.accept')}}</button>
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
            @include('events.accept', ['event' => $event])
            @include('events.user_reject', ['event' => $event])
        </div>
    </div>
@stop
