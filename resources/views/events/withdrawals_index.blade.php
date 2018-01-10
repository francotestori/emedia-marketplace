@extends('layouts.insite-layout')

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>
                        {{Lang::get('titles.withdrawal')}}
                    </h3>
                </div>
                <div class="col-lg-6">
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
                                <td colspan="4">No Companies Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
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
