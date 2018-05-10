@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-6 emedia-title user-basic-info">
                    <div class="avatar-container">
                        <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
                    </div>
                    <div class="info-container">
                        <h1>
                            <strong>{{$user->name}}</strong>
                        </h1>
                        <p class="subheading">
                            {{$user->email}}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 emedia-title">
                    <div class="pull-right user-edit-btns">
                        @if(Auth::user()->id == $user->id)
                            <a href="{{route('users.password', $user->id)}}" class="">{{Lang::get('forms.users.change')}}</a>
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-emedia">{{Lang::get('forms.basic.edit')}}</a>
                        @endif
                    </div>
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
            <div class="row">
                <div class="col-md-8">
                    <h2>{{Lang::get('titles.wallet.index')}}</h2>
                </div>
                <div class="col-md-4 balance">
                    @if(Auth::user()->isEditor())
                        <button data-toggle="modal" data-target="#withdrawModal" class="btn btn-block btn-emedia pull-right">{{Lang::get('forms.basic.withdraw')}}</button>
                    @elseif(Auth::user()->isAdvertiser())
                        <a href="{{route('deposit')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.deposit')}}</a>
                    @endif
                </div>
            </div>
            <br>
            @if(Auth::user()->id == $user->id || Auth::user()->isManager())
                <div class="row">
                    <div class="col-md-12">
                        @if($user->isAdvertiser())
                            @include('wallet.advertiser.transactions',['user' => $user, 'transactions' => $transactions])
                        @else
                            <table class="table" id="addspaces-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                                <thead>
                                <tr>
                                    <th>{{Lang::get('tables.wallet.type')}}</th>
                                    <th>{{Lang::get('tables.wallet.action')}}</th>
                                    <th>{{Lang::get('tables.wallet.date')}}</th>
                                    <th>{{Lang::get('tables.wallet.state')}}</th>
                                    <th>{{Lang::get('tables.wallet.amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($user->getWallet()->getTransactions()))
                                    @foreach($user->getWallet()->getTransactions() as $transaction)
                                        @if(($transaction->getEvent() != null && !$transaction->getEvent()->rejected()) ||
                                            $transaction->type == 'DEPOSIT' ||
                                            $transaction->type == 'WITHDRAWAL')
                                            <tr>
                                                <td>
                                                    @if($transaction->from_wallet == $user->getWallet()->id)
                                                        {{Lang::get('tables.DEBIT')}}
                                                    @else
                                                        {{Lang::get('tables.CREDIT')}}
                                                    @endif
                                                </td>
                                                <td>{{Lang::get('tables.'.$transaction->type)}}</td>
                                                <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                                <td>
                                                    <?php
                                                    $status = $transaction->getEvent() == null ? 'SYSTEM' : $transaction->getEvent()->state;
                                                    $state = Lang::get('tables.'.$status);

                                                    switch($status)
                                                    {
                                                        case 'ACCEPTED':
                                                            $class = "btn-success btn-table-border";
                                                            break;
                                                        case 'PENDING':
                                                            $class = "btn-warning btn-table-border";
                                                            break;
                                                        default:
                                                            $class = "btn-danger btn-table-border";
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="btn btn-block {{$class}}">{{$state}}</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <strong>{{Lang::get('attributes.currency')}}</strong>
                                                        {{$transaction->amount}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{Lang::get('messages.no_items_found')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">{{Lang::get('tables.wallet.total')}}</td>

                                    <td>
                                        <span class="money-total">
                                            <strong>{{Lang::get('attributes.currency')}}</strong>
                                            {{$user->getWallet()->getTransactionsBalance()}}
                                        </span>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
                <br>
            @endif
        </div>
        <br>

        <div class="panel-heading">
            @if($user->isEditor())
                <div class="panel-title">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>{{Lang::get('titles.addspaces.web')}}</h2>
                        </div>
                    </div>
                </div>
                @foreach(array_chunk($user->getUsableAddspaces()->toArray(), 3) as $cluster)
                    <div class="row">
                        @foreach($cluster as $addspace)
                            <div class="col-md-4 user-weburl-box">
                                <span class="btn btn-block btn-default">
                                    <!--<strong>{{$addspace['id'].' - '}}</strong>-->
                                    <a target="_blank" href="{{route('addspaces.show',$addspace['id'])}}">{{$addspace['url']}}</a>
                                </span>
                            </div>

                        @endforeach
                    </div>
                    <br>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('modals')
    @if($user->isEditor())
        @include('wallet.modal.withdrawal')
    @endif
@endsection

@section('custom-js')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        // datatable
        $('[data-ride="datatables"]').each(function() {
            var oTable = $(this).dataTable(
                {
                    "language": {
                        "paginate": {
                            "previous": "{{Lang::get('tables.previous')}}",
                            "next": "{{Lang::get('tables.next')}}",
                            "first": "{{Lang::get('tables.first')}}",
                            "last": "{{Lang::get('tables.last')}}"
                        },
                        "emptyTables": "{{Lang::get('tables.empty')}}",
                        "lengthMenu": "{{Lang::get('tables.lengthMenu')}}",
                        "info": "{{Lang::get('tables.info')}}",
                        "search": "{{Lang::get('tables.search')}}"
                    }
                }
            );
        });
    </script>
@endsection
