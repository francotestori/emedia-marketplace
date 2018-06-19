

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{Lang::get('titles.emedia')}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet">

    <link href="{{ asset('css/styles2.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    @yield('custom-css')
    <script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
</head>
<body>

@yield('modals')

<div class="container-fluid display-table">
    <!-- Viejo Menu
    <div class="row" id="topbar">
        <div class="col-md-12 col-sm-12 display-table-cell v-align">
            <div class="row">
                <header>
                    <div class="col-md-3 home-logo">
                        <a href="{{url('/home')}}">
                            <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="hidden-xs hidden-sm">
                            <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">

                            </div>
                        </nav>
                    </div>

                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="btn btn-success btn-header">
                                    <a href="{{route('wallet')}}" class="">
                                        <strong>{{"U\$D ".Auth::user()->getWallet()->balance}}</strong>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{ Config::get('languages')[App::getLocale()] }}
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach (Config::get('languages') as $lang => $language)
                                            @if ($lang != App::getLocale())
                                                <li>
                                                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('messages')}}" class="icon-info">
                                            @if(Auth::user()->getPendingThreadCount() > 0)
                                                    <i class="fa fa-envelope" aria-hidden="true">
                                                        <span class="label label-primary">{{Auth::user()->getPendingThreadCount()}}</span>
                                                    </i>
                                            @else
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            @endif
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="user.html" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i>
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span>{{ Auth::user()->name }}</span>
                                                <p class="text-muted small">
                                                    {{ Auth::user()->email }}
                                                </p>
                                                <div class="divider">
                                                </div>
                                                <a href="{{route('users.show', Auth::user()->id)}}" class="btn btn-sm btn-simple-emedia btn-table-border active">{{Lang::get('menu.profile')}}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="topbar-logout">
                                    <a href="{{ route('logout') }}"  class="logout-view btn-sm"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
        </div>        
    </div> -->
    <div class="row" id="topbar"><!-- nuevo menu -->
        <div class="col-md-3 hidden-xs hidden-sm home-logo">
            <a href="{{url('/home')}}">
                <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="">
                <!-- visible en sm y xs
                <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="circle-logo"> -->
            </a>
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">                    
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
            <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="" aria-expanded="false" aria-controls="">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>            
            <ul class="list-inline header-top pull-right">
                <li class="btn btn-success btn-header hidden-xs">
                    <a href="{{route('wallet')}}" class="">
                        <strong>{{"U\$D ".Auth::user()->getWallet()->balance}}</strong>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Config::get('languages')[App::getLocale()] }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{route('messages')}}" class="icon-info">
                            @if(Auth::user()->getPendingThreadCount() > 0)
                                    <i class="fa fa-envelope" aria-hidden="true">
                                        <span class="label label-primary">{{Auth::user()->getPendingThreadCount()}}</span>
                                    </i>
                            @else
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            @endif
                    </a>
                </li>
                <li class="dropdown">
                    <a href="user.html" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-content">
                                <span>{{ Auth::user()->name }}</span>
                                <p class="text-muted small">
                                    {{ Auth::user()->email }}
                                </p>
                                <div class="divider">
                                </div>
                                <a href="{{route('users.show', Auth::user()->id)}}" class="btn btn-sm btn-simple-emedia btn-table-border active">{{Lang::get('menu.profile')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="topbar-logout">
                    <a href="{{ route('logout') }}"  class="logout-view btn-sm"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>
            </ul>
        </div>
    </div><!-- nuevo menu END -->

    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <div class="navi">
                <ul>
                    <!--
                    <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                    -->
                    @if(Auth::user() != null && Auth::user()->isManager())
                        <li><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.search')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.web.admin')}}</span></a></li>
                        <li><a href="{{url('users').'?type=editor'}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.editors')}}</span></a></li>
                        <li><a href="{{url('users').'?type=advertiser'}}"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.advertisers')}}</span></a></li>
                        <li><a href="{{route('transactions')}}"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.transactions')}}</span></a></li>
                        <li><a href="{{route('packages')}}"><i class="fa fa-ticket" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.packages.admin')}}</span></a></li>
                        <li><a href="{{route('profits.index')}}"><i class="fa fa-percent" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.profits')}}</span></a></li>
                        <li><a href="{{route('revenues')}}"><i class="fa fa-usd" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.revenues')}}</span></a></li>
                        <li><a href="{{route('withdrawal.index')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.withdrawals')}}</span></a></li>
                    @elseif(Auth::user() != null && Auth::user()->isEditor())
                        <li><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.index')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.web.editor')}}</span></a></li>
                        <li><a href="{{route('sales')}}"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.sales')}}</span></a></li>
                        <li><a href="{{route('wallet')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.wallet')}}</span></a></li>
                    @elseif(Auth::user() != null && Auth::user()->isAdvertiser())
                        <li><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.search')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.web.advertiser')}}</span></a></li>
                        <li><a href="{{route('payments')}}"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.purchases')}}</span></a></li>
                        <li><a href="{{route('packages')}}"><i class="fa fa-ticket" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.packages.advertiser')}}</span></a></li>
                        <li><a href="{{route('wallet')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.wallet')}}</span></a></li>
                    @endif
                    <li class="sidebar-help">
                        <a href="{{url('/faq')}}">
                            <i class="fa fa-question" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">{{Lang::get('menu.sidebar.help')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <div class="user-dashboard">
                @yield('content')
            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="offcanvas"]').click(function(){
            $("#navigation").toggleClass("hidden-xs");
        });
    });

</script>
@yield('custom-js')
</body>

</html>
