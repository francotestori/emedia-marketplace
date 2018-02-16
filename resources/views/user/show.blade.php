@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>
                                <span>
                                    <strong>{{$user->name}}</strong>
                                </span>
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h4>
                                <span>
                                    {{$user->email}}
                                </span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 balance">
                        <div class="pull-right">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(Auth::user()->id == $user->id)
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-lg">{{Lang::get('messages.edit')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>{{Lang::get('messages.wallet')}}</h3>
                            </div>
                            <div class="col-md-2 balance">
                                <h4>{{Lang::get('items.balance')}}</h4>
                                @if($user->isManager())
                                    <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getSystemBalance()}}</p>
                                @else
                                    <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getWallet()->balance}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 balance pull-right">
                        @if(Auth::user()->isEditor())
                            <button data-toggle="modal" data-target="#withdrawModal" class="btn btn-warning btn-lg">{{Lang::get('messages.withdraw')}}</button>
                        @elseif(Auth::user()->isAdvertiser())
                            <a href="{{route('deposit')}}" class="btn btn-warning btn-lg">{{Lang::get('messages.deposit')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            @if(Auth::user()->id == $user->id || Auth::user()->isManager())
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="addspaces-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Action</th>
                                <th>Date</th>
                                <th>State</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($user->getWallet()->getTransactions()))
                                @foreach($user->getWallet()->getTransactions() as $transaction)
                                    @if(($transaction->getEvent() != null && !$transaction->getEvent()->rejected()) ||
                                        $transaction->type == 'DEPOSIT' ||
                                        $transaction->type == 'WITHDRAWAL')
                                        <tr>
                                            <td>{{$transaction->from_wallet == $user->getWallet()->id ? 'DEBIT' : 'CREDIT'}}</td>
                                            <td>{{$transaction->type}}</td>
                                            <td class="">
                                                {{Carbon\Carbon::parse($transaction->created_at)}}
                                            </td>
                                            <td>{{$transaction->getEvent() != null ? $transaction->getEvent()->state : 'SYSTEM'}}</td>
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
                                <td colspan="4">Total</td>
                                <td>{{$user->getWallet()->getTransactionsBalance()}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif
            @if($user->isEditor())
                <br>
                <div class="panel-titulo2">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Editor's addspaces</h4>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
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
            var oTable = $(this).dataTable();
        });
    </script>
@endsection
