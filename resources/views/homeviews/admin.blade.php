<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h2>{{Lang::get('titles.home.admin.welcome', ['name' => $user->name])}}</h2>
                <h4>{{Lang::get('titles.home.admin.manage')}} <strong>{{Lang::get('titles.emedia')}}</strong>.</h4>
            </div>
            <div class="col-md-6">
                <h3>{{Lang::get('titles.profile')}}</h3>
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{asset('img/avatar.png')}}" class="img-responsive img-circle">
                    </div>
                    <div class="col-md-6">
                        <p><strong>{{$user->getRole()}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-heading bloque ce">
        <div class="row">
            <h3>{{Lang::get('titles.home.admin.activity')}}</h3>
            <div class="col-md-6 servicios">
                <h1>{{count($advertisers)}}<i class="fa fa-bullhorn " aria-hidden="true"></i></h1>
                <p>{{Lang::get('items.advertisers')}}</p>
                <a href="{{route('users.create', ['role' => 2])}}" class="btn btn-primary azul">{{Lang::get('forms.basic.create')}}</a>
            </div>
            <div class="col-md-6 servicios">
                <h1>{{count($editors)}} <i class="fa fa-pencil-square-o " aria-hidden="true"></i></h1>
                <p>{{Lang::get('items.editors')}}</p>
                <a href="{{route('users.create', ['role' => 1])}}" class="btn btn-primary amarrillo">{{Lang::get('forms.basic.create')}}</a>
            </div>
        </div>
    </div>
    <div class="panel-heading bloque">
        <div class="panel-titulo2">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <h3>{{Lang::get('titles.wallet.index')}}</h3>
                        </div>
                        <div class="col-md-2 balance">
                            <h4>{{Lang::get('titles.wallet.balance')}}</h4>
                            <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getWallet()->balance}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
