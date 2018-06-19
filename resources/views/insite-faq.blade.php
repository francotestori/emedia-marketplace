@extends('layouts.insite-layout')

@section('custom-css')
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <h1>{{Lang::get('titles.home.common.faq')}}</h1>            
        </div>
        <br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger" role="alert">
                {{ session('errors') }}
            </div>
        @endif
        <?php 
            $class = "";
            if(Auth::user()->isAdvertiser()){
                $class = "faq-advertiser-only";
            } elseif(Auth::user()->isEditor()) {
                $class = "faq-editor-only";
            }
        ?>
        <div class="faq-panel">
            <div class="faq-section faq-advertiser {{$class}}">
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
                </div>
            </div><!-- .advertiser END -->
            <div class="faq-section faq-editor {{$class}}">
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
                </div>
            </div><!-- .faq-editor END -->
        </div>
    </div>
@stop

@section('custom-js')
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
@endsection
