<?php

use App\Event;
use App\EventThreads;
use Illuminate\Support\Facades\Auth;

$event_thread = EventThreads::where('thread_id', $thread->id)->first();
$event = Event::find($event_thread->event_id);
switch($event->state)
{
    case 'ACCEPTED':
        $class = "btn-success btn-table-border";
        break;
    case 'PENDING':
        $class = "btn-info btn-table-border";
        break;
    default:
        $class = "btn-danger btn-table-border";
        break;
}
$search_id = Auth::user()->isEditor() ? 'to_wallet' : 'from_wallet';
$wallet_id = Auth::user()->getWallet()->id;
$transaction = $event->transactions()->where($search_id, $wallet_id)->first();
?>

<div class="row">
    <div class="col-md-12">
        <div class="media alert alert-default">
            <h4 class="media-heading">
                <span>
                    <a href="{{ route('messages.show', $thread->id) }}">
                        <strong>{{Lang::get('titles.subject', ['id' => $transaction->id, 'subject' => $thread->subject])}}</strong>
                    </a>
                    ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)
                </span>
            </h4>
            <span>
                <strong>{{Lang::get('items.messenger.from')}}</strong> {{ $thread->participantsString(Auth::id()) }}
            </span>
            @if(!$event->pending())
                <h5>
                    <span>
                        {{Lang::get('messages.threads.operation')}}
                    </span>
                </h5>
                <h5>
                    <strong class="btn {{$class}}" disabled>{{Lang::get('messages.threads.'.$event->state)}}</strong>
                </h5>
            @else
                <h5>
                    <span>
                        {{Lang::get('messages.threads.open')}}
                    </span>
                </h5>
                <h5>
                    <strong class="btn {{$class}}" disabled>{{$event->state}}</strong>
                </h5>
            @endif
        </div>
    </div>
</div>