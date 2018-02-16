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
                <div class="row">
                    <div class="col-md-10">
                        <h3>{{Lang::get('messages.revenues')}}</h3>
                        <p>{{Lang::get('messages.revenues_subtitle')}}</p>
                    </div>
                    <div class="col-md-2 balance">
                        <h4>{{Lang::get('items.balance')}}</h4>
                        <p><strong>{{Lang::get('attributes.currency')}}</strong> {{$user->getSystemBalance()}}</p>
                    </div>
                </div>
            </div>
            <br>
                <table class="table table-bordered" id="addspaces-table" @if(count($user->getWallet()->getTransactions())) data-ride="datatables" @endif>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{Lang::get('items.web_or_blog')}}</th>
                        <th>{{Lang::get('items.date')}}</th>
                        <th>{{Lang::get('items.amount')}}</th>
                        <th>{{Lang::get('items.state')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($user->getWallet()->getTransactions()))
                        @foreach($user->getWallet()->getTransactions() as $transaction)
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
                                    <span class="@if($transaction->getEvent() == null) alert-info @elseif($transaction->getEvent()->pending()) alert-warning @elseif($transaction->getEvent()->rejected()) alert-danger @else alert-success @endif">
                                        {{$transaction->getEvent() != null ? $transaction->getEvent()->state : 'SYSTEM'}}
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
