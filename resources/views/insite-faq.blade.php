@extends('layouts.insite-layout')

@section('custom-css')
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <h3>Preguntas frecuentes</h3>
                </div>
            </div>
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

        <div class="panel-heading">
            <section class="faq" id="faq">
                <div class="row">

                    <div class="col-md-6">
                        <div class="col-md-10 col-md-offset-2 accordion accordion-3 z-depth-1-half" role="tablist" aria-multiselectable="true" id="accordionAdvertiser">
                            <br>
                            <img src="{{asset('img/anunciante.png')}}" class="img-responsive center-block">
                            <hr class="mb-0">

                            <div class="card">
                                <div class="card-header" role="tab" id="heading1">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.first.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.first.tuft')}}
                                        </p>
                                        <ul>
                                            <li>{{Lang::get('faq.advertiser.first.items.1')}}</li>
                                            <li>{{Lang::get('faq.advertiser.first.items.2')}}</li>
                                            <li>{{Lang::get('faq.advertiser.first.items.3')}}</li>
                                            <li>{{Lang::get('faq.advertiser.first.items.4')}}</li>
                                            <li>{{Lang::get('faq.advertiser.first.items.5')}}</li>
                                            <li>{{Lang::get('faq.advertiser.first.items.6')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading2">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.second.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="heading2" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.second.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading3">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.third.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading3" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.third.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading4">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.fourth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="heading4" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.fourth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading5">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.fifth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse5" class="collapse" role="tabpanel" aria-labelledby="heading5" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.fifth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading6">
                                    <a data-toggle="collapse" data-parent="#accordionAdvertiser" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.advertiser.sixth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse6" class="collapse" role="tabpanel" aria-labelledby="heading6" data-parent="#accordionAdvertiser">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.advertiser.sixth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <p>{{Lang::get('faq.advertiser.message')}}</p>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="col-md-10 accordion accordion-3 z-depth-1-half" role="tablist" aria-multiselectable="true" id="accordionEditor">
                            <br>
                            <img src="{{asset('img/editor.png')}}" class="img-responsive center-block">
                            <hr class="mb-0">

                            <div class="card">
                                <div class="card-header" role="tab" id="heading1B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse1B" aria-expanded="false" aria-controls="collapse1B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.first.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse1B" class="collapse" role="tabpanel" aria-labelledby="heading1B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.first.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading2B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse2B" aria-expanded="false" aria-controls="collapse2B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.second.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse2B" class="collapse" role="tabpanel" aria-labelledby="heading2B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.second.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading3B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse3B" aria-expanded="false" aria-controls="collapse3B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.third.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse3B" class="collapse" role="tabpanel" aria-labelledby="heading3B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.third.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading4B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse4B" aria-expanded="false" aria-controls="collapse4B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.fourth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse4B" class="collapse" role="tabpanel" aria-labelledby="heading4B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.fourth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading5B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse5B" aria-expanded="false" aria-controls="collapse5B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.fifth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse5B" class="collapse" role="tabpanel" aria-labelledby="heading5B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.fifth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading6B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse6B" aria-expanded="false" aria-controls="collapse6B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.sixth.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse6B" class="collapse" role="tabpanel" aria-labelledby="heading6B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.sixth.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading7B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse7B" aria-expanded="false" aria-controls="collapse7B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.seventh.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse7B" class="collapse" role="tabpanel" aria-labelledby="heading7B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.seventh.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" role="tab" id="heading8B">
                                    <a data-toggle="collapse" data-parent="#accordionEditor" href="#collapse8B" aria-expanded="false" aria-controls="collapse8B">
                                        <h3 class="mb-0 mt-3 red-text">
                                            {{Lang::get('faq.editor.eight.title')}}
                                            <i class="fa fa-angle-down rotate-icon fa-2x"></i>
                                        </h3>
                                    </a>
                                </div>

                                <!-- Card body -->
                                <div id="collapse8B" class="collapse" role="tabpanel" aria-labelledby="heading8B" data-parent="#accordionEditor">
                                    <div class="card-body pt-0">
                                        <p>
                                            {{Lang::get('faq.editor.eight.tuft')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <p>{{Lang::get('faq.editor.message')}}</p>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
@stop

@section('custom-js')
@endsection
