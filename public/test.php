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
    <script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-default  navbar-static-top">
    <div class="container">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#page-top"><!--ESTAMOS EN TEST -->
                <img src="{{asset('img/logo.png')}}" class="imagen-logo img-responsive" alt="Dr. Juan Manuel Bulario">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="portafolio.php"></a>
                </li>
                <li>
                    <a class="page-scroll noamarrillo" href="javascript:void(0);" onclick="javascript:$.scrollTo('#como-funciona', 800);">{{Lang::get('menu.navbar.how')}}</a>
                </li>
                <li>
                    <a class="page-scroll noamarrillo" href="javascript:void(0);" onclick="javascript:$.scrollTo('#quienes-somos', 800);">{{Lang::get('menu.navbar.who')}}</a>
                </li>
                <li>
                    <a class="page-scroll noamarrillo" href="javascript:void(0);" onclick="javascript:$.scrollTo('#contacto', 800);">{{Lang::get('menu.navbar.contact')}}</a>
                </li>
                <li>
                    <a class="page-scroll amarrillo" href="{{route('login', ['role' => 'advertiser'])}}">{{Lang::get('menu.navbar.advertisers')}}</a>
                </li>
                <li>
                    <a class="page-scroll azul extra" href="{{route('login', ['role' => 'editor'])}}">{{Lang::get('menu.navbar.editors')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron">
    <div class="container">
        <h1>{{Lang::get('menu.main.connecting.first')}}<br>
            {{Lang::get('menu.main.connecting.second')}}</h1>
        <img src="{{asset('img/icon.png')}}" class="img-responsive center-block">
        <h2>{{Lang::get('menu.main.optimizing.first')}}<br>
            {{Lang::get('menu.main.optimizing.second')}}</h2>
        <a href="#" class="btn btn-primary btn-lg center-block info" role="button">{{Lang::get('menu.main.more')}}</a>
    </div>
</div>
<section class="como-hacemos" id="hacemos">
    <div class="container">
        <h3>{{Lang::get('menu.main.how.title')}}</h3>
        <p>{{Lang::get('menu.main.how.description')}}</p>
        <div class="row">
            <div class="col-md-6 anunciante">
                <img src="{{asset('img/anunciante.png')}}" class="img-responsive center-block">
                <h5>{{Lang::get('menu.main.advertisers.who.first')}}<br>
                    {{Lang::get('menu.main.advertisers.who.second')}}</h5>
                <p>{{Lang::get('menu.main.advertisers.description')}}<br></p>
                <img src="{{asset('img/flecha.png')}}" class="img-responsive center-block">
                <a href="{{route('register', ['role' => 'advertiser'])}}" class="btn btn-primary btn-lg center-block boton-hacemos" role="button">{{Lang::get('menu.main.register')}}<strong>{{Lang::get('menu.main.advertisers.as')}}</strong></a>
            </div>
            <div class="col-md-6 editor">
                <img src="{{asset('img/editor.png')}}" class="img-responsive center-block">
                <h5>{{Lang::get('menu.main.editors.who.first')}}<br>
                    {{Lang::get('menu.main.editors.who.second')}}</h5>
                <p>{{Lang::get('menu.main.editors.description')}}<br></p>
                <img src="{{asset('img/flecha.png')}}" class="img-responsive center-block">
                <a href="{{route('register', ['role' => 'editor'])}}" class="btn btn-primary btn-lg center-block boton-hacemos azul2" role="button">{{Lang::get('menu.main.register')}}<strong>{{Lang::get('menu.main.editors.as')}}</strong></a>
            </div>
        </div>
    </div>
</section>
<section class="como-funciona" id="como-funciona">
    <h3>{{Lang::get('menu.navbar.how')}}</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                <img src="{{asset('img/comofunciona1.png')}}" class="img-responsive center-block">
            </div>
            <div class="col-sm-3 col-md-3">
                <img src="{{asset('img/comofunciona2.png')}}" class="img-responsive center-block">
            </div>
            <div class="col-sm-3 col-md-3">
                <img src="{{asset('img/comofunciona3.png')}}" class="img-responsive center-block">
            </div>
            <div class="col-sm-3 col-md-3">
                <img src="{{asset('img/comofunciona4.png')}}" class="img-responsive center-block">
            </div>
        </div>
        <a href="#" class="btn btn-primary btn-lg center-block boton-funciona" role="button"  data-toggle="modal" data-target="#myModal">{{Lang::get('menu.main.start')}}<strong>{{Lang::get('menu.main.now')}}</strong></a>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h2><strong>{{Lang::get('menu.main.register')}}</strong></h2>
                <img src="{{asset('img/icono1.png')}}" class="img-responsive center-block">
                <a href="{{route('register', ['role' => 'advertiser'])}}" class="btn btn-primary btn-lg center-block boton-hacemos" role="button"><strong>{{Lang::get('menu.main.advertisers.as')}}</strong></a>
                <hr>
                <img src="{{asset('img/icono2.png')}}" class="img-responsive center-block">
                <a href="{{route('register', ['role' => 'editor'])}}" class="btn btn-primary btn-lg center-block boton-hacemos azul2 margin-2" role="button">{{Lang::get('menu.main.register')}}<strong>{{Lang::get('menu.main.editors.as')}}</strong></a></div>
        </div>
    </div>
</div>

<section class="quienes-somos" id="quienes-somos">
    <div class="container">
        <div class="row">
            <div class="col-md-6 quienes-izquierda">
                <h2>{{Lang::get('menu.navbar.who')}}</h2>
                <h3>{{Lang::get('menu.main.emedia.about')}}</h3>
                <p>
                    {{Lang::get('menu.main.emedia.description.first')}}
                    <strong>{{Lang::get('menu.main.emedia.description.second')}}</strong>
                    {{Lang::get('menu.main.emedia.description.third')}}
                </p>
                <p>{{Lang::get('menu.main.emedia.bullet.first')}}<strong>{{Lang::get('menu.main.editors.as')}}</strong></p>
                <p>{{Lang::get('menu.main.emedia.bullet.second')}}<strong>{{Lang::get('menu.main.advertisers.as')}}</strong></p>
                <img src="{{asset('img/icon.png')}}" class="img-responsive">
                <p class="mediamarket-1">
                    <strong>{{Lang::get('menu.main.emedia.birth.title')}}</strong>
                    {{Lang::get('menu.main.emedia.birth.first')}}
                    <strong>{{Lang::get('menu.main.emedia.birth.second')}}</strong>
                    {{Lang::get('menu.main.emedia.birth.third')}}
                    <strong>{{Lang::get('menu.main.emedia.birth.fourth')}}</strong>
                    {{Lang::get('menu.main.emedia.birth.fifth')}}
                </p>
            </div>
            <div class="col-md-6 quienes-derecha center-block">
                <img src="{{asset('img/imagen5.png')}}" class="img-responsive center-block">
            </div>
        </div>
    </div>
</section>
<section class="anunciarse">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <img src="{{asset('img/imagen4.png')}}" class="img-responsive center-block">
            </div>
            <div class="col-md-6">
                <h2>
                    {{Lang::get('menu.main.why.title.first')}}
                    <br>
                    <strong>{{Lang::get('menu.main.why.title.second')}}</strong>
                </h2>
                <p><strong>{{Lang::get('menu.main.why.bullet.first.first')}}</strong>{{Lang::get('menu.main.why.bullet.first.second')}}</p>
                <p>{{Lang::get('menu.main.why.bullet.second.first')}}<strong>{{Lang::get('menu.main.why.bullet.second.second')}}</strong></p>
                <p><strong>{{Lang::get('menu.main.why.bullet.third.first')}}</strong>{{Lang::get('menu.main.why.bullet.third.second')}}</p>
                <p><strong>{{Lang::get('menu.main.why.bullet.fourth')}}</strong></p>
                <p><strong>{{Lang::get('menu.main.why.bullet.fifth')}}</strong></p>
                <a href="#" class="btn btn-primary btn-lg  boton-funciona" role="button"><strong>{{Lang::get('menu.main.more')}}</strong></a>
            </div>
        </div>
    </div>
</section>
<section class="contacto" id="contacto">
    <h2>{{Lang::get('menu.main.contact.title')}}</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>
                    {{Lang::get('menu.main.contact.description.one')}}
                    <strong>{{Lang::get('menu.main.contact.description.two')}}</strong>
                    {{Lang::get('menu.main.contact.description.three')}}
                    <strong>{{Lang::get('menu.main.contact.description.four')}}</strong>
                    {{Lang::get('menu.main.contact.description.five')}}
                    <strong>{{Lang::get('menu.main.contact.description.six')}}</strong>
                    {{Lang::get('menu.main.contact.description.seven')}}
                    <strong>{{Lang::get('menu.main.contact.description.eight')}}</strong>
                    {{Lang::get('menu.main.contact.description.nine')}}
                    <strong>{{Lang::get('menu.main.contact.description.ten')}}</strong>
                    {{Lang::get('menu.main.contact.description.eleven')}}<br></p>
                <p>{{Lang::get('menu.main.contact.contacting')}}<br>
                </p>
                <img src="{{asset('img/email.png')}}" class="img-responsive">
                <p><strong>info@emediamarket.com</strong></p>
                <img src="{{asset('img/ubication.png')}}" class="img-responsive">
                <p><strong>San Isidro, Buenos Aires, Argentina.</strong></p>
            </div>
            <div class="col-md-6">
                <div class="formulario">
                    <form>
                        <div class="form-group">
                            <label for="nombreId" class="control-label">{{Lang::get('forms.contact.name')}}</label>
                            <input type="text" class="form-control" id="nombreId">
                        </div>
                        <div class="form-group">
                            <label for="emailId" class="control-label">{{Lang::get('forms.contact.email')}}</label>
                            <input type="email" id="emailId" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comentarioId" class="control-label">{{Lang::get('forms.contact.message')}}</label>
                            <textarea id="comentarioId" class="form-control"></textarea>
                            <button class="btn btn-primary btn-lg boton-funciona"><strong>{{Lang::get('forms.basic.send')}}</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
<footer>
</footer>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
</body>

</html>
