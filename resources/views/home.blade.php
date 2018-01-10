@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"><h2>{{Lang::get('messages.welcome', ['name' => Auth::user()->name])}}</h2>
                    <h4>Aún no has realizado ningún pedido</h4>
                    <p>¿Necesitas ayuda? Contacta con nuestro soporte y te ayudaremos a crear tu primera campaña.</p>
                    <button type="button" class="btn btn-primary">Cómo funciona</button>
                    <button type="button" class="btn btn-success">Guía para editores</button>
                </div>
                <div class="col-md-6">
                    <h3>Perfil de usuario</h3>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{Auth::user()->name}}</strong></p>
                            <p><strong>Número total de afiliados:</strong> 0</p>
                            <a href="{{route('users.show', Auth::user()->id)}}">Ver perfil completo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-heading segundo-bloque ce">
            <h3>Añade tus servicios</h3>
            <div class="row">
                <div class="col-md-2 col-md-offset-1 redes-bloque">
                    <a href="#">
                        <i class="fa fa-desktop centrar redes" aria-hidden="true"></i><p>Web</p>
                    </a>
                </div>
                <div class="col-md-2 redes-bloque">
                    <a href="#">
                        <i class="fa fa-pencil centrar redes" aria-hidden="true"></i><p>Redactores</p>
                    </a>
                </div>
                <div class="col-md-2 redes-bloque">
                    <a href="#">
                        <i class="fa fa-facebook centrar redes" aria-hidden="true"></i>
                        <p>Facebook</p>
                    </a>
                </div>
                <div class="col-md-2 redes-bloque">
                    <a href="#">
                        <i class="fa fa-twitter centrar redes" aria-hidden="true"></i>
                        <p>Twitter</p>
                    </a>
                </div>
                <div class="col-md-2 redes-bloque">
                    <a href="#">
                        <i class="fa fa-instagram centrar redes" aria-hidden="true"></i>
                        <p>Instagram</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-heading tercer-bloque">
            <div class="row">
                <div class="col-md-6">
                    <h3>Cómo funciona eMediaMarket</h3>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading2" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ¿Pregunta numero 1?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    TODO config loadable answer
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading2" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        ¿Pregunta numero #2?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    TODO config loadable answer
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading2" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        ¿Pregunta numero #3?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    TODO config loadable answer
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Soporte</h3>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('img/susan-full.png')}}" class="img-responsive img-circle">
                        </div>
                        <div class="col-md-6 perfil-derecho">
                            <p><strong>Ana Doe</strong></p>
                            <p>
                                <a href="mailto:anadoe@emediamarket.com"><i class="fa fa-envelope" aria-hidden="true"></i>
                                    anadoe@emediamarket.com</a></p>
                            <p><a href="skype:anadoe?chat"><i class="fa fa-skype" aria-hidden="true"></i>
                                    anadoe</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
