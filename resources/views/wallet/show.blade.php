@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>{{Lang::get('titles.wallet.index')}}</h3>
                            </div>
                            <div class="col-md-2 balance">
                                <h4>{{Lang::get('titles.wallet.balance')}}</h4>
                                <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getWallet()->balance}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 balance pull-right">
                        @if(Auth::user()->isEditor())
                            <button data-toggle="modal" data-target="#withdrawModal" class="btn btn-warning">{{Lang::get('forms.basic.withdraw')}}</button>
                        @elseif(Auth::user()->isAdvertiser())
                            <a href="{{route('deposit')}}" class="btn btn-warning">{{Lang::get('forms.basic.deposit')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            @if(Auth::user()->id == $user->id || Auth::user()->isManager())
                <div class="row">
                    <div class="col-md-12">
                        @include('wallet.advertiser.transactions',['user' => $user, 'transactions' => $transactions])
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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