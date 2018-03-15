@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{Lang::get('titles.wallet.transactions.main')}}</h3>
                        <p>{{Lang::get('titles.wallet.transactions.subtitle')}}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered" id="addspaces-table" @if(count($transactions)) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>{{Lang::get('tables.wallet.id')}}</th>
                            <th>{{Lang::get('tables.wallet.web')}}</th>
                            <th>{{Lang::get('tables.wallet.date')}}</th>
                            <th>{{Lang::get('tables.wallet.buyer')}}</th>
                            <th>{{Lang::get('tables.wallet.seller')}}</th>
                            <th>{{Lang::get('tables.wallet.state')}}</th>
                            <th>{{Lang::get('tables.wallet.amount')}}</th>
                            <th>{{Lang::get('tables.wallet.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($transactions))
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td><strong>{{$transaction->id}}</strong></td>
                                    <td>
                                        @if($transaction->isSystem())
                                            <span>{{$transaction->type}}</span>
                                        @else
                                            <a href="{{$transaction->getAddspace()->url}}">{{$transaction->getAddspace()->url}}</a>
                                        @endif
                                    </td>
                                    <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                    <td>{{$transaction->isSystem() ? $transaction->getReceiver()->getUser()->name : $transaction->getSender()->getUser()->name}}</td>
                                    <td>{{$transaction->isSystem() ? $transaction->getSender()->getUser()->name : $transaction->getReceiver()->getUser()->name}}</td>
                                    <td>
                                        <span class="@if($transaction->getEvent() == null) alert-info
                                                     @elseif($transaction->getEvent()->pending()) alert-warning
                                                     @elseif($transaction->getEvent()->rejected() || $transaction->getEvent()->rejectedByUser()) alert-danger
                                                     @else alert-success
                                                     @endif">
                                        {{$transaction->getEvent() != null ? $transaction->getEvent()->state : 'SYSTEM'}}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <strong>{{Lang::get('attributes.currency')}}</strong>
                                            {{$transaction->amount}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($transaction->getEvent() != null && $transaction->getEvent()->rejectedByUser())
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="{{'#reject'.$transaction->getEvent()->id}}">{{Lang::get('forms.transactions.reject')}}</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="{{'#accept'.$transaction->getEvent()->id}}">{{Lang::get('forms.transactions.accept')}}</button>
                                            @include('events.accept', ['event' => $transaction->getEvent()])
                                            @include('events.reject', ['event' => $transaction->getEvent()])
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{Lang::get('messages.no_items_found')}}</td>
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