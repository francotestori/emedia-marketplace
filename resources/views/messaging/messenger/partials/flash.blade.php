<div class="panel-title">
    <div class="row">
        <div class="col-md-12 emedia-title">
            <h1>{{Lang::get('titles.messages')}}</h1>
            <p class="subheading">{{Lang::get('messages.messenger.tuft')}}</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
        </div>
    </div>
</div>
<br>
