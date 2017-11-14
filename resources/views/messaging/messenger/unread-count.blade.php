<?php $count = Auth::user() != null ? Auth::user()->newThreadsCount() : 0; ?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif
