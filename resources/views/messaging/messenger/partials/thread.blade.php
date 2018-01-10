<?php

use App\Event;
use App\EventThreads;
use Illuminate\Support\Facades\Auth;

$class = $thread->isUnread(Auth::id()) ? 'alert-info' : 'alert-success';
$event_thread = EventThreads::where('thread_id', $thread->id)->first();
$event = Event::find($event_thread->event_id);
?>

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
        <strong>From:</strong> {{ $thread->participantsString(Auth::id()) }}
    </span>
    @if(!$event->pending())
        <h4>
            <span>
                Thread has been closed by <strong>{{$event->state}}</strong>
            </span>
        </h4>
    @else
        <h4>
            <span>
                Thread is still open. <strong>{{$event->state}}</strong>
            </span>
        </h4>
    @endif
</div>