<div class="panel panel-default">
    <div class="panel panel-title">
        <div class="row">
            <div class="col-md-2">
                <img src="{{asset('img/avatar.png')}}" class="img-responsive img-circle">
            </div>
            <div class="col-md-10">
                <h2>
                    {{Lang::get('titles.home.admin.welcome')}}
                    <strong>{{$user->name}}</strong>
                </h2>
                <h4>{{Lang::get('titles.home.admin.manage')}} <strong>{{Lang::get('titles.emedia')}}</strong>.</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 home-background center-block">
            <h4>
                <i class="fa fa-pencil-square-o" aria-hidden></i>
                {{Lang::get('items.editors')}}
            </h4>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5 home-background center-block">
            <h4>
                <i class="fa fa-bullhorn" aria-hidden></i>
                {{Lang::get('items.advertisers')}}
            </h4>
        </div>

    </div>
    <div class="row">
        <div class="col-md-5 panel-heading center-block">
            <h1><strong>{{count($editors)}}</strong></h1>
            <a href="{{route('users.create', ['role' => 1])}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.create')}}</a>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5 panel-heading center-block">
            <h1><strong>{{count($advertisers)}}</strong></h1>
            <a href="{{route('users.create', ['role' => 2])}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.create')}}</a>
        </div>
    </div>
</div>
