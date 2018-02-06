

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>eMediaMarket</title>

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
    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <div class="logo">
                <a href="{{url('/home')}}">
                    <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="hidden-xs hidden-sm">
                    <img src="{{asset('img/login-anunciantes.png')}}" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                </a>
            </div>
            <div class="navi">
                <ul>
                    <!--
                    <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                    -->
                    @if(Auth::user() != null && Auth::user()->isManager())
                        <li><a href="{{url('/home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.index')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.web_or_blog')}}</span></a></li>
                        <li><a href="{{route('users.index')}}"><i class="fa fa-users" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.users')}}</span></a></li>
                        <li><a href="{{route('withdrawal.index')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.withdrawals')}}</span></a></li>
                        <li><a href="{{route('config')}}"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.config')}}</span></a></li>
                    @elseif(Auth::user() != null && Auth::user()->isEditor())
                        <li><a href="{{url('/home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.index')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.web_or_blog')}}</span></a></li>
                        <li><a href="{{route('sales')}}"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.sales')}}</span></a></li>
                        <li><a href="{{route('wallet')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.wallet')}}</span></a></li>
                    @elseif(Auth::user() != null && Auth::user()->isAdvertiser())
                        <li><a href="{{url('/home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.home')}}</span></a></li>
                        <li><a href="{{route('addspaces.search')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.web_or_blog')}}</span></a></li>
                        <li><a href="{{route('payments')}}"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.purchases')}}</span></a></li>
                        <li><a href="{{route('packages')}}"><i class="fa fa-ticket" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.packages')}}</span></a></li>
                        <li><a href="{{route('wallet')}}"><i class="fa fa-money" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{Lang::get('messages.wallet')}}</span></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
            <div class="row">
                <header>
                    <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li>
                                    <a href="{{route('messages')}}" class="icon-info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        @if(Auth::user()->newThreadsCount() > 0)
                                            <span class="label label-primary">{{Auth::user()->newThreadsCount()}}</span>
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
                                                <a href="{{route('users.show', Auth::user()->id)}}" class="view btn-sm active">View Profile</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="navbar-content">
                                                <a href="{{ route('logout') }}"  class="logout-view btn-sm"
                                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    {{Lang::get('messages.logout')}}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
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
