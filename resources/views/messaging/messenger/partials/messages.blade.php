<div class="media alert-message clearfix">
    <a class="{{$message->user->id == Auth::id() ? 'pull-left' : 'pull-right'}}" href="#">
        <img src="{{$message->user->id == Auth::id() ?  asset('img/avatar.png'): asset('img/avatar.png')}}"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>
    <div class="media-body formulario">
        <h5 class="media-heading  {{$message->user->id == Auth::id() ? 'pull-left' : 'pull-right'}}">
            <strong>{{ $message->user->name }}</strong>
            <div class="text-muted right">
                <small>{{Lang::get('items.messenger.posted')}} {{Carbon\Carbon::parse($message->created_at->diffForHumans())}}</small>
            </div>
        </h5>
        <br>
        <hr>
        <br>
        <p class="clearfix">{{ $message->body }}</p>
    </div>
</div>
<hr>