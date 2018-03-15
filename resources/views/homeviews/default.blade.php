<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"><h2>{{Lang::get('titles.home.common.welcome', ['name' => $user->name])}}</h2>
                <h4>{{Lang::get('titles.home.common.activity')}}</h4>
                <p>{{Lang::get('titles.home.common.contact')}}</p>
                <button type="button" class="btn btn-primary">{{Lang::get('titles.home.common.how')}}</button>
                @if($user->isEditor())
                    <button type="button" class="btn btn-success">{{Lang::get('titles.home.common.guide')}}</button>
                @endif
            </div>
            <div class="col-md-6">
                <h3>{{Lang::get('titles.profile')}}</h3>
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
                    </div>
                    <div class="col-md-6">
                        <p><strong>{{$user->name}}</strong></p>
                        <a href="{{route('users.show', $user->id)}}">{{Lang::get('titles.home.common.check')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-heading segundo-bloque ce">
        <div class="row">
            <div class="col-md-6 servicios">
                <h3>{{Lang::get('titles.home.common.services')}}</h3>
            </div>
            <div class="col-md-6">
                <a href="{{Auth::user()->isEditor() ? route('addspaces.index') : route('addspaces.search')}}">
                    <i class="fa fa-desktop centrar redes" aria-hidden="true"></i>
                    <span class="centrar">{{Lang::get('titles.addspaces.web')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-heading tercer-bloque">
        <div class="row">
            <div class="col-md-6">
                <h3>{{Lang::get('titles.home.common.us')}}</h3>
                <a href="mailto:info@emediamarket.com">info@emediamarket.com</a>
            </div>
        </div>
    </div>
</div>
