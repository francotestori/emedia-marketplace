<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    @yield('metadata')
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

                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('img/logo.png')}}" class="imagen-logo img-responsive" alt="EMedia Market">
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{asset('img/logo.png')}}" class="imagen-logo img-responsive" alt="EMedia Market">
                    </a>
                @endguest
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        @guest
                            <li><a class="noamarrillo" href="{{ route('login', ['role' => !isset($requested) || $requested  == null ? null : $requested]) }}">{{Lang::get('menu.login')}}</a></li>
                            <li><a class="noamarrillo" href="{{ route('register', ['role' => !isset($requested) || $requested == null ? null : $requested]) }}">{{Lang::get('menu.register')}}</a></li>
                        @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
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
@yield('custom-js')

</body>

</html>
