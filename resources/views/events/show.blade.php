@extends('layouts.emedia-layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>
                                    <span>Withdrawal</span>
                                </h3>
                            </div>
                            <div class="col-lg-6">
                                @if(Auth::user()->isManager())
                                    <div class="pull-right">
                                        <button data-toggle="modal" data-target="#authorize-modal" class="btn btn-warning btn-lg">{{Lang::get('messages.authorize')}}</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body formulario">
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
                        <div class="row">
                            <div class="col-lg-12">
                                <p>From: {{$transaction->getReceiver()->getUser()->email}}</p>
                                <p>{{$transaction->type}}</p>
                                <p>{{$transaction->amount}} $USD</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="authorize-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Authorize Withdrawal</h4>
                </div>
                <div class="modal-body formulario">
                    <p>Are you willing to authorize and execute the following withdrawal request?.</p>
                    {{Form::open(['route' => ['withdrawal.authorize', $transaction->id]])}}

                    <div class="form-group">
                        {{Form::label('state', Lang::get('messages.state'))}}
                        {{Form::select('state', ['ACCEPTED' => 'ACCEPT','REJECTED' => 'REJECT',], 'ACCEPTED', ['class' => 'form-control'])}}
                    </div>

                    <!--Buttons-->
                    <div class="form-group">
                        <a href="" class="btn btn-def" data-dismiss="modal">{{Lang::get('messages.cancel')}}</a>
                        {{Form::submit(Lang::get('messages.accept'), ['class' => 'btn btn-primary'])}}
                    </div>

                    {{Form::close()}}
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
