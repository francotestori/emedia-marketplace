@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12 emedia-title">
                    <h1 class="heading">{{Lang::get('messages.sales')}}</h1>
                    <p class="subheading">{{Lang::get('messages.sales_subtitle')}}</p>
                </div>
            </div>
        </div>
        <br>

        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">

                    <table class="table" id="sales-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{Lang::get('tables.purchases.web')}}</th>
                            <th>{{Lang::get('tables.purchases.date')}}</th>
                            <th>{{Lang::get('tables.purchases.amount')}}</th>
                            <th>{{Lang::get('items.advertiser')}}</th>
                            <th>{{Lang::get('tables.purchases.state')}}</th>
                            <th>{{Lang::get('tables.purchases.message')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($user->getWallet()->getCredits()))
                            @foreach($user->getWallet()->getCredits() as $transaction)
                                <tr>
                                    <td>
                                        <strong>{{$transaction->id}}</strong>
                                    </td>
                                    <td>{{$transaction->getAddspace()->url}}</td>
                                    <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                    <td>
                                        <span>
                                            <strong>{{Lang::get('attributes.currency')}}
                                            {{$transaction->amount}}</strong>
                                        </span>
                                    </td>
                                    <td>{{$transaction->getSender()->getUser()->name}}</td>
                                    <td class="col-estado-venta" align="center">
                                        <?php
                                        $class = $transaction->getEvent() == null ? 'btn-emedia' :
                                                 $transaction->getEvent()->pending() ? 'btn-warning':
                                                 $transaction->getEvent()->rejected() || $transaction->getEvent()->rejectedByUser() ? 'btn-danger':
                                                 'btn-success';
                                        ?>

                                        <span class="btn btn-block {{$class}} btn-table-border">
                                            @if($transaction->getEvent() == null)
                                            {{Lang::get('tables.SYSTEM')}}
                                            @else
                                            {{Lang::get('tables.'.$transaction->getEvent()->state)}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="msj-col"><a href="{{route('messages.show', $transaction->getEvent()->getThread()->id)}}"><i class="fa fa-envelope"></i></a></td>
                                </tr>
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