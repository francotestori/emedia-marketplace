<div class="media {{$message->user->id == Auth::id() ? 'left alert-warning' : 'right alert-info'}} clearfix">
    <a class="{{$message->user->id == Auth::id() ? 'pull-left' : 'pull-right'}}" href="#">
        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>
    <div class="media-body formulario">
        <h5 class="media-heading  {{$message->user->id == Auth::id() ? 'pull-left' : 'pull-right'}}">
            <strong>{{ $message->user->name }}</strong>
            <div class="text-muted right">
                <small>Posted {{ $message->created_at->diffForHumans() }}</small>
            </div>
        </h5>
        <br>
        <hr>
        <br>
        <p class="clearfix">{{ $message->body }}</p>
    </div>
</div>
<hr>