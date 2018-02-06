<div class="panel-titulo2">
    <h3>{{Lang::get('messages.messages')}}</h3>
    @if (Session::has('errors'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('errors') }}
        </div>
    @endif
</div>
<br>
