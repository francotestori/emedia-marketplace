@extends('layouts.insite-layout')

@section('custom-css')
    <link href="{{asset('css/bootstrap-slider.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-10 emedia-title">
                    <h3>{{Lang::get('titles.wallet.revenues.main')}}</h3>
                    <p>{{Lang::get('titles.wallet.revenues.subtitle')}}</p>
                </div>
                <div class="col-md-2 balance emedia-title">
                    <h4>{{Lang::get('titles.wallet.revenues.item')}}</h4>
                    <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getWallet()->balance}}</p>
                </div>
            </div>
        </div>
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

        <br>

        <div class="panel-heading">
                <table class="table" id="addspaces-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                    <thead>
                    <tr>
                        <th>{{Lang::get('tables.wallet.id')}}</th>
                        <th>{{Lang::get('tables.wallet.web')}}</th>
                        <th>{{Lang::get('tables.wallet.date')}}</th>
                        <th>{{Lang::get('tables.wallet.amount')}}</th>
                        <th>{{Lang::get('tables.wallet.state')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($user->getWallet()->getRevenues()))
                        @foreach($user->getWallet()->getRevenues() as $transaction)
                            <tr>
                                <td>
                                    <strong>{{$transaction->id}}</strong>
                                </td>
                                <td>{{$transaction->getAddspace() != null ? $transaction->getAddspace()->url : $transaction->type}}</td>
                                <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                <td>
                                    <span>
                                        <strong>{{Lang::get('attributes.currency')}}</strong>
                                        {{$transaction->amount}}
                                    </span>
                                </td>
                                <td>
                                    <span class="btn btn-block btn-table-border
                                                               @if($transaction->getEvent() == null) btn-info
                                                               @elseif($transaction->getEvent()->pending()) btn-warning
                                                               @elseif($transaction->getEvent()->rejected()) btn-danger
                                                               @else btn-success
                                                               @endif" disabled>
                                        @if($transaction->getEvent() != null)
                                            {{Lang::get('tables.'.$transaction->getEvent()->state)}}
                                        @else
                                            {{Lang::get('tables.SYSTEM')}}
                                        @endif
                                    </span>
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
@stop

@section('custom-js')
@endsection
