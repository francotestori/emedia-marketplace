@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span><strong>{{$user->name}}</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span>{{$user->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if(Auth::user()->id == $user->id)
                                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-info">{{Lang::get('messages.edit')}}</a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if(Auth::user()->isEditor())
                                                <a href="#" class="btn btn-warning">{{Lang::get('messages.withdraw')}}</a>
                                            @elseif(Auth::user()->isAdvertiser())
                                                <a href="#" class="btn btn-warning">{{Lang::get('messages.deposit')}}</a>
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
                                            <li>
                                            <span>
                                                {{$transaction->type.' - '.$transaction->credits.' - '}}{{$transaction->getAddspace() == null ? 'system' : 'to: '.$transaction->getAddspace()->getEditor()->name}}
                                            </span>
                                            </li>
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
@endsection
