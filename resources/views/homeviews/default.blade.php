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
            <div class="col-md-6"><h2>{{Lang::get('messages.welcome', ['name' => $user->name])}}</h2>
                <h4>Aún no has realizado ningún pedido</h4>
                <p>¿Necesitas ayuda? Contacta con nuestro soporte y te ayudaremos a crear tu primera campaña.</p>
                <button type="button" class="btn btn-primary">Cómo funciona</button>
                @if($user->isEditor())
                    <button type="button" class="btn btn-success">Guía para editores</button>
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
                        <a href="{{route('users.show', $user->id)}}">{{Lang::get('messages.check_profile')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-heading segundo-bloque ce">
        <div class="row">
            <div class="col-md-6 servicios">
                <h3>{{Lang::get('messages.add_services')}}</h3>
            </div>
            <div class="col-md-6">
                <a href="#">
                    <i class="fa fa-desktop centrar redes" aria-hidden="true"></i>
                    <p>Web</p>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-heading tercer-bloque">
        <div class="row">
            <div class="col-md-6">
                <h3>{{Lang::get('messages.contact')}}</h3>
                <a href="mailto:info@emediamarket.com">info@emediamarket.com</a>
            </div>
        </div>
    </div>
</div>
