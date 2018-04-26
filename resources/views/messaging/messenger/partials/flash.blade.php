<div class="panel-title">
    <h1>{{Lang::get('titles.messages')}}</h1>
    <h5>{{Lang::get('messages.messenger.tuft')}}</h5>
    @if (Session::has('errors'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('errors') }}
        </div>
    @endif
</div>
<br>
