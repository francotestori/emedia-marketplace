@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{Lang::get('messages.purchases')}}</h3>
                        <p>{{Lang::get('messages.purchases_subtitle')}}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered" id="payments-table" @if(count($user->getWallet()->getDebits())) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{Lang::get('items.web_or_blog')}}</th>
                            <th>{{Lang::get('items.date')}}</th>
                            <th>{{Lang::get('items.amount')}}</th>
                            <th>{{Lang::get('items.recipient')}}</th>
                            <th>{{Lang::get('items.state')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($user->getWallet()->getDebits()) > 0)
                            @foreach($user->getWallet()->getDebits() as $transaction)
                                @if($transaction->getEvent() != null && $transaction->getEvent()->accepted())
                                <tr>
                                    <td>
                                        <strong>{{$transaction->id}}</strong>
                                    </td>
                                    <td>{{$transaction->getAddspace()->url}}</td>
                                    <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                    <td>
                                        <span>
                                            <strong>{{Lang::get('attributes.currency')}}</strong>
                                            {{$transaction->amount}}
                                        </span>
                                    </td>
                                    <td>{{$transaction->getReceiver()->getUser()->name}}</td>
                                    <td>
                                        <span class="@if($transaction->getEvent() == null) alert-info @elseif($transaction->getEvent()->pending()) alert-warning @elseif($transaction->getEvent()->rejected()) alert-danger @else alert-success @endif">
                                        {{$transaction->getEvent() != null ? $transaction->getEvent()->state : 'SYSTEM'}}
                                        </span>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">{{Lang::get('messages.no_items_found')}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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