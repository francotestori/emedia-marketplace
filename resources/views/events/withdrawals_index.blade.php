@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
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
            <div class="panel-titulo2">
                <h3>{{Lang::get('messages.withdrawals')}}</h3>
            </div>
            <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered" id="addspaces-table" @if(count($withdrawals)) data-ride="datatables" @endif>
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>From</th>
                                <th>State</th>
                                <th>Amount</th>
                                <th>Authorize</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($withdrawals))
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{$withdrawal->id}}</td>
                                        <td>{{$withdrawal->getSender()->getUser()->email}}</td>
                                        <td>{{$withdrawal->getEvent()->state}}</td>
                                        <td>{{$withdrawal->amount}}</td>
                                        <td>
                                            @if($withdrawal->getEvent()->pending())
                                                <a data-original-title="Authorize" class="btn btn-info" href="{{route('withdrawal.show', ['transaction_id' => $withdrawal->id])}}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">{{Lang::get('messages.no_items_found')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@stop

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
