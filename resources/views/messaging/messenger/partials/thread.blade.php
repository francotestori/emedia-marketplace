<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : 'alert-success'; ?>

<div class="media alert {{ $class }}">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</h4>
    @if($thread->latestMessage != null)
    <p>{{ $thread->latestMessage->body }}</p>

    @endif
<!--
    <p>
        <small><strong>Creator:</strong> {{$thread->creator()->name }}</small>
    </p>
-->
    <p>
        <small><strong>From:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
    </p>
</div>