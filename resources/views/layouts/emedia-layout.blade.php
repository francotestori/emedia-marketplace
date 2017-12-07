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

    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    @yield('custom-css')

    <script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
</head>
<body>

    <nav class="navbar navbar-default ">
        <div class="container">
            <div class="navbar-header ">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/logo.png')}}" class="imagen-logo img-responsive" alt="EMedia Market">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::user() != null && Auth::user()->isManager())
                        <li><a class="noamarrillo" href="{{route('config')}}">{{Lang::get('messages.config')}}</a></li>
                        <li><a class="noamarrillo" href="{{route('users')}}">{{Lang::get('messages.users')}}</a></li>
                        <li><a class="noamarrillo" href="{{route('addspaces')}}">{{Lang::get('messages.addspaces')}}</a></li>
                    @elseif(Auth::user() != null)
                        <li><a class="noamarrillo" href="{{route('addspaces')}}">{{Lang::get('messages.addspaces')}}</a></li>
                        <li><a class="noamarrillo" href="{{route('messages')}}">Messages @include('messaging.messenger.unread-count')</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="noamarrillo" href="{{ route('login') }}">{{Lang::get('messages.login')}}</a></li>
                        <li><a class="noamarrillo" href="{{ route('register') }}">{{Lang::get('messages.register')}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('users.show', Auth::user()->id)}}">Profile</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                {{Lang::get('messages.logout')}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>

    <div class="jumbotron login-anunciantes">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <footer>
        <section class="pie">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ">
                        <img src="{{asset('img/logo-footer.jpg')}}" class="img-responsive center-block">
                    </div>
                    <div class="col-md-6 redes-sociales center-block">
                        <i class="fa fa-facebook center-block" aria-hidden="true"></i>
                        <i class="fa fa-twitter center-block" aria-hidden="true"></i>
                        <i class="fa fa-vine center-block" aria-hidden="true"></i>
                        <i class="fa fa-linkedin center-block" aria-hidden="true"></i>
                        <i class="fa fa-instagram center-block" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </section>
    </footer>


<!-- Scripts -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
@yield('custom-js')

</body>

</html>
