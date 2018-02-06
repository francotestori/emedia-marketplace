<?php

use App\Event;
use App\EventThreads;
use Illuminate\Support\Facades\Auth;

$event_thread = EventThreads::where('thread_id', $thread->id)->first();
$event = Event::find($event_thread->event_id);
$state_class = $event->state == 'REJECTED' ? 'alert-danger' : 'alert-success';
$class = $thread->isUnread(Auth::id()) ? 'alert-info' : $state_class;
?>

<div class="row">
    <div class="col-md-12">
        <div class="media alert {{ $class }}">
            <h4 class="media-heading">
                <span>
                    <a href="{{ route('messages.show', $thread->id) }}">
                        <strong>Subject:</strong> {{ $thread->subject }}
                    </a>
                    ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)
                </span>
            </h4>
            <span>
                <strong>{{Lang::get('items.from')}}</strong> {{ $thread->participantsString(Auth::id()) }}
            </span>
            @if(!$event->pending())
                <h4>
                    <span>
                        {{Lang::get('messages.thread_close')}} <strong>{{$event->state}}</strong>
                    </span>
                </h4>
            @else
                <h4>
                    <span>
                        {{Lang::get('messages.thread_open')}} <strong>{{$event->state}}</strong>
                    </span>
                </h4>
            @endif
        </div>
    </div>
</div>