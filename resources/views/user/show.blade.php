@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>
                                            <span>
                                                <strong>{{$user->name}}</strong>
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>
                                            <span>
                                                {{$user->email}}
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if(Auth::user()->id == $user->id)
                                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-lg">{{Lang::get('messages.edit')}}</a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if(Auth::user()->isEditor())
                                                <button data-toggle="modal" data-target="#withdrawModal" class="btn btn-warning btn-lg">{{Lang::get('messages.withdraw')}}</button>
                                            @elseif(Auth::user()->isAdvertiser())
                                                <a href="{{route('deposit')}}" class="btn btn-warning btn-lg">{{Lang::get('messages.deposit')}}</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>

                        @if(Auth::user()->id == $user->id || Auth::user()->isManager())
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Wallet Balance</h3>
                                    <span><strong>{{$user->getWallet()->balance}} credits</strong></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>TRANSACTIONS</h4>
                                    <ul>
                                        @foreach($user->getWallet()->getTransactions() as $transaction)
                                            @if($transaction->completed())
                                                <li>
                                            <span>
                                                {{$transaction->type.' - '.$transaction->credits.' - '}}{{$transaction->getAddspace() == null ? 'system' : 'to: '.$transaction->getAddspace()->getEditor()->name}}
                                            </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if($user->isEditor())
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Editor's addspaces</h4>
                                    <ul>
                                        @foreach($user->addspaces()->get() as $addspace)
                                            <li>
                                            <span>
                                                {{$addspace->id}} -<a href="{{route('addspaces.show',$addspace->id)}}">Addspace - {{$addspace->url}}</a>
                                            </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="withdrawModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Withdrawal</h4>
                </div>
                <div class="modal-body">
                    <p>Insert your paypal of bank account details and specify desired withdrawal amount.</p>
                    {{Form::open(['route' => 'withdraw'])}}

                    <div class="form-group">
                        {{Form::label('paypal', Lang::get('messages.paypal_account'))}}
                        {{Form::text('paypal', Input::old('paypal'), ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('cbu', Lang::get('messages.cbu'))}}
                        {{Form::text('cbu', Input::old('cbu'), ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('alias', Lang::get('messages.alias'))}}
                        {{Form::text('alias', Input::old('alias'), ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('comment', Lang::get('messages.comment'))}}
                        {{Form::textarea('comment', Input::old('comment'), ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('amount', Lang::get('messages.amount'))}}
                        {{Form::number('amount', Input::old('amount'), ['class' => 'form-control', 'min' => $min, 'max' => $max])}}
                    </div>

                    <!--Buttons-->
                    <div class="form-group">
                        <a href="" class="btn btn-def" data-dismiss="modal">{{Lang::get('messages.cancel')}}</a>
                        {{Form::submit(Lang::get('messages.create'), ['class' => 'btn btn-primary'])}}
                    </div>

                    {{Form::close()}}
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
