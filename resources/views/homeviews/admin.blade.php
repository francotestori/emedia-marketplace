<div class="panel panel-default admin-home">
    <div class="panel-title">
        <div class="row home-welcome">
            <div class="avatar-container">
                <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
            </div>
            <div class="home-welcome-text">
                <h2>
                    {{Lang::get('titles.home.admin.welcome')}}
                    <strong>{{$user->name}}</strong>
                </h2>
                <h4 class="subheading">{{Lang::get('titles.home.admin.manage')}} <strong>{{Lang::get('titles.emedia')}}</strong>.</h4>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="col-md-6 col-sm-12">
            <div class="admin-home-editors">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-pencil-square-o" aria-hidden></i>
                        <a href="{{url('users').'?type=editor'}}">{{Lang::get('items.editors')}}</a>
                    </h3>
                </div>
                <div class="box-content">
                    <h1><strong>{{count($editors)}}</strong></h1>
                    <button href="{{route('users.create', ['role' => 1])}}" class="btn btn-block btn-emedia">
                        {{Lang::get('forms.basic.create')}}
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="admin-home-advertisers">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bullhorn" aria-hidden></i>
                        <a href="{{url('users').'?type=advertiser'}}">{{Lang::get('items.advertisers')}}</a>
                    </h3>
                </div>
                <div class="box-content">
                    <h1><strong>{{count($advertisers)}}</strong></h1>
                    <button href="{{route('users.create', ['role' => 2])}}" class="btn btn-block btn-emedia">
                        {{Lang::get('forms.basic.create')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
