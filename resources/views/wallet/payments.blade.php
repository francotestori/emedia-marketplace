@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{Lang::get('titles.purchases.index')}}</h3>
                    <p>{{Lang::get('titles.purchases.subtitle.index')}}</p>
                </div>
            </div>
        </div>
        <br>

        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">

                    <table class="table" id="payments-table" @if(count($user->getWallet()->getDebits())) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{Lang::get('tables.purchases.web')}}</th>
                            <th>{{Lang::get('tables.purchases.date')}}</th>
                            <th>{{Lang::get('tables.purchases.amount')}}</th>
                            <th>{{Lang::get('tables.purchases.recipient')}}</th>
                            <th>{{Lang::get('tables.purchases.state')}}</th>
                            <th>{{Lang::get('tables.purchases.message')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($user->getWallet()->getDebits()) > 0)
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>
                                        <strong>{{$transaction['id']}}</strong>
                                    </td>
                                    <td>{{$transaction['url']}}</td>
                                    <td>{{$transaction['date']}}</td>
                                    <td>
                                        <span>
                                            <strong>{{Lang::get('attributes.currency')}}</strong>
                                            {{$transaction['amount']}}
                                        </span>
                                    </td>
                                    <td>{{$transaction['owner']}}</td>
                                    <td>
                                        <?php
                                        switch($transaction['state'])
                                        {
                                            case 'ACCEPTED':
                                                $class = "btn-success";
                                                break;
                                            case 'PENDING':
                                                $class = "btn-warning";
                                                break;
                                            default:
                                                $class = "btn-danger";
                                                break;
                                        }
                                        ?>
                                        <span class="btn btn-block btn-table-border {{$class}}">{{Lang::get('tables.'.$transaction['state'])}}</span>
                                    </td>
                                    <td><a href="{{route('messages.show', $transaction['thread_id'])}}"><i class="fa fa-inbox"></i></a></td>
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