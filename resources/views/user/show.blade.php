@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>
                                <span>
                                    <strong>{{$user->name}}</strong>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>
                                <span>
                                    {{$user->email}}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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

            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                </div>
            </div>

            @if(Auth::user()->id == $user->id || Auth::user()->isManager())
                <div class="row">
                    <div class="col-md-12">
                        <div class="detalles-texto">Wallet Balance</div>
                        <div class="detalles">
                            <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getWallet()->balance}}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="detalles-texto">TRANSACTIONS</div>
                        <div class="detalles">
                            <table class="table table-bordered" id="addspaces-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Action</th>
                                    <th>Amount</th>
                                    <th>State</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($user->getWallet()->getTransactions()))
                                    @foreach($user->getWallet()->getTransactions() as $transaction)
                                        <tr class="@if($transaction->getEvent() == null) alert-info @elseif($transaction->getEvent()->pending()) alert-warning @elseif($transaction->getEvent()->rejected()) alert-danger @else alert-success @endif">
                                            <td>{{$transaction->from_wallet == $user->getWallet()->id ? 'DEBIT' : 'CREDIT'}}</td>
                                            <td>{{$transaction->type}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td>{{$transaction->getEvent() != null ? $transaction->getEvent()->state : 'SYSTEM'}}</td>
                                            <td class="">
                                                {{$transaction->created_at}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No Companies Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if($user->isEditor())
                <div class="row">
                    <div class="col-md-12">
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
@endsection

@section('modals')
    <!-- Modal -->
    <div id="withdrawModal" class="modal fade" role="dialog" style="margin-top: -10%;">
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
                        <div class="col-md-6">
                            <a class="btn btn-def btn-lg" data-dismiss="modal">{{Lang::get('messages.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            {{Form::submit(Lang::get('messages.create'), ['class' => 'btn btn-primary  btn-lg'])}}
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
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
