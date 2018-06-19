<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{Lang::get('seo.faq.description')}}">
    <meta name="author" content="">
    <title>{{Lang::get('seo.faq.title')}}</title>
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
            <a class="navbar-brand" href="/">
                <img src="{{asset('img/logo.png')}}" class="imagen-logo img-responsive" alt="Dr. Juan Manuel Bulario">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="portafolio.php"></a>
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
        <h1>{{Lang::get('titles.home.common.faq')}}</h1>
    </div>
</div>

<div class="faq-panel">
  <div class="faq-section faq-advertiser">
    <div class="faq-title">
      <img src="{{asset('img/icono1.png')}}" alt="megaphone">
      <h1>{{Lang::get('items.advertisers')}}</h1>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.first.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
        <p>{{Lang::get('faq.advertiser.first.tuft')}}</p>        
        <p>- {{Lang::get('faq.advertiser.first.items.1')}}</p>
        <p>- {{Lang::get('faq.advertiser.first.items.2')}}</p>
        <p>- {{Lang::get('faq.advertiser.first.items.3')}}</p>
        <p>- {{Lang::get('faq.advertiser.first.items.4')}}</p>
        <p>- {{Lang::get('faq.advertiser.first.items.5')}}</p>
        <p>- {{Lang::get('faq.advertiser.first.items.6')}}</p>
        
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.second.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.advertiser.second.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.third.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.advertiser.third.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.fourth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.advertiser.fourth.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.fifth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.advertiser.fifth.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.advertiser.sixth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.advertiser.sixth.tuft')}}</p>
    </div>
    <div class="faq-footer">
        <p>{{Lang::get('faq.advertiser.message')}}</p>
        <img src="{{asset('img/flecha.png')}}" alt="chevron-down">
        <a href="{{route('register', ['role' => 'advertiser'])}}" class="faq-register">
            {{Lang::get('menu.main.register')}}<strong>{{Lang::get('menu.main.advertisers.as')}}</strong>
        </a>
    </div>
  </div><!-- .advertiser END -->
  <div class="faq-section faq-editor">
    <div class="faq-title">
      <img src="{{asset('img/icono2blanco.png')}}" alt="pencil">
      <h1>{{Lang::get('items.editors')}}</h1>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.first.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.first.tuft.1')}}</p>
      <p>{{Lang::get('faq.editor.first.tuft.2')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.second.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.second.tuft.1')}}</p>
      <p>{{Lang::get('faq.editor.second.tuft.2')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.third.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.third.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.fourth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.fourth.tuft.1')}}</p>
      <p>{{Lang::get('faq.editor.fourth.tuft.2')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.fifth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.fifth.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.sixth.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.sixth.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.seventh.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.seventh.tuft')}}</p>
    </div>
    <button class="faq-accordion">{{Lang::get('faq.editor.eight.title')}}
    <i class="fa fa-caret-right" aria-hidden="true"></i></button>
    <div class="faq-answer">
      <p>{{Lang::get('faq.editor.eight.tuft.1')}}</p>
      <p>{{Lang::get('faq.editor.eight.tuft.2')}}</p>
    </div>
    <div class="faq-footer">
        <p>{{Lang::get('faq.editor.message.1')}} </p>
        <p>{{Lang::get('faq.editor.message.2')}} </p>
        <img src="{{asset('img/flecha.png')}}" alt="chevron-down">
        <a href="{{route('register', ['role' => 'editor'])}}" class="faq-register">
            {{Lang::get('menu.main.register')}}<strong>{{Lang::get('menu.main.editors.as')}}</strong>
        </a>
    </div>
  </div><!-- .faq-editor END -->
</div><!-- .faq-panel END -->

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
<script>//Accodrion funcionalidad
    var acc = document.getElementsByClassName("faq-accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");
            var caret = this.children[0];
            if (caret.classList.contains("fa-caret-right")) {
              caret.classList.remove("fa-caret-right");
              caret.classList.add("fa-caret-down");
            } else {
              caret.classList.remove("fa-caret-down");
              caret.classList.add("fa-caret-right");
            }

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            /*if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }*/
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
  </script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
</body>

</html>
