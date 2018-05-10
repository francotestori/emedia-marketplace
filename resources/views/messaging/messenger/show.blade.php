@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-10 emedia-title">
                    <div class="breadcrumbs">
                        <a href="{{route('sales')}}"> Ventas </a> / Mensajes
                    </div>
                    <h1>{{ $thread->subject }}</h1>
                    @if(!$event->pending())
                        <span> {{Lang::get('messages.threads.operation')}} <strong>{{Lang::get('messages.threads.'.$event->state)}}</strong></span>
                    @endif
                    @if($event->pending() && Auth::user()->isAdvertiser())
                        <h5>{{Lang::get('messages.messenger.accepting')}}</h5>
                        <h5>{{Lang::get('messages.messenger.rejecting')}}</h5>
                    @endif
                </div>
                <div class="col-md-2 pull-right emedia-title">
                    @if(Auth::user()->isAdvertiser() && $event->pending())
                        <button class="btn btn-danger" data-toggle="modal" data-target="{{'#reject'.$event->id}}">{{Lang::get('forms.messenger.reject')}}</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="{{'#accept'.$event->id}}">{{Lang::get('forms.messenger.accept')}}</button>
                    @endif
                </div>
            </div>
        </div>

        <br>

        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-12">
                    @each('messaging.messenger.partials.messages', $thread->messages, 'message')
                    @if($event->pending())
                        <hr>
                        @include('messaging.messenger.partials.form-message')
                    @endif
                </div>
            </div>
            @include('events.accept', ['event' => $event])
            @include('events.user_reject', ['event' => $event])
        </div>
    </div>
@stop

@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/star.css')}}">
@endsection

@section('custom-js')
    <script src="{{asset('js/star.js')}}"></script>
    <script>
        var rater = new SimpleStarRating(document.getElementById('myRating'));

        rater.onrate = function (rating) {
            // Called whenever the SimpleStarRating is clicked
        };

        document.getElementById('myRating').addEventListener('rate', function (e) {
            // e.detail contains the rating
            document.getElementById('score').value = e.detail;
        });
    </script>
@endsection
