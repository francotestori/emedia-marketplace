<?php
use App\Transaction;

$transactions = Transaction::all();
?>

@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{Lang::get('messages.transactions')}}</h3>
                        <p>{{Lang::get('messages.transactions_subtitle')}}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered" id="addspaces-table" @if(count($transactions)) data-ride="datatables" @endif>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{Lang::get('items.web_or_blog')}}</th>
                            <th>{{Lang::get('items.date')}}</th>
                            <th>{{Lang::get('items.buyer')}}</th>
                            <th>{{Lang::get('items.seller')}}</th>
                            <th>{{Lang::get('items.state')}}</th>
                            <th>{{Lang::get('items.amount')}}</th>
                            <th>{{Lang::get('attributes.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($transactions))
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td><strong>{{$transaction->id}}</strong></td>
                                    <td>{{$transaction->getEvent() == null ? $transaction->type : $transaction->getAddspace()->url}}</td>
                                    <td>{{Carbon\Carbon::parse($transaction->created_at)}}</td>
                                    <td>{{$transaction->isSystem() ? $transaction->getReceiver()->getUser()->name : $transaction->getSender()->getUser()->name}}</td>
                                    <td>{{$transaction->isSystem() ? $transaction->getSender()->getUser()->name : $transaction->getReceiver()->getUser()->name}}</td>
                                    <?php
                                        $class = $transaction->getEvent() == null ? 'alert-info'
                                                                                  : ($transaction->getEvent()->pending() ? 'alert-warning'
                                                                                  : ($transaction->getEvent()->rejected() || $transaction->getEvent()->rejectedByUser()) ? 'alert-danger' : 'alert-success');
                                    ?>
                                    <td>
                                        <span class="{{$class}}">
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
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="{{'#reject'.$transaction->getEvent()->id}}">{{Lang::get('forms.reject')}}</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="{{'#accept'.$transaction->getEvent()->id}}">{{Lang::get('forms.accept')}}</button>
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
            var oTable = $(this).dataTable();
        });
    </script>
@endsection