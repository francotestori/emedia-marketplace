<table class="table table-trans" id="addspaces-table" @if(count($transactions)) data-ride="datatables" @endif>
    <thead>
    <tr>
        <th>{{Lang::get('tables.wallet.type')}}</th>
        <th>{{Lang::get('tables.wallet.action')}}</th>
        <th>{{Lang::get('tables.wallet.date')}}</th>
        <th>{{Lang::get('tables.wallet.state')}}</th>
        <th>{{Lang::get('tables.wallet.web')}}</th>
        <th>{{Lang::get('tables.wallet.amount')}}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($transactions))
        @foreach($transactions as $transaction)
            <tr>
                <td>{{Lang::get('tables.'.$transaction['type'])}}</td>
                <td>{{Lang::get('tables.'.$transaction['action'])}}</td>
                <td>{{$transaction['date']}}</td>
                <td class="col-estado-trans">
                    <?php
                    switch($transaction['state'])
                    {
                        case 'SYSTEM':
                            $class = "btn-info btn-table-border";
                            break;
                        case 'ACCEPTED':
                            $class = "btn-success btn-table-border";
                            break;
                        case 'PENDING':
                            $class = "btn-warning btn-table-border";
                            break;
                        default:
                            $class = "btn-danger btn-table-border";
                            break;
                    }
                    ?>
                    <span class="btn btn-block {{$class}}">{{Lang::get('tables.'.$transaction['state'])}}</span>
                </td>
                <td>
                    <a target="_blank" href="{{$transaction['url']}}">{{$transaction['url']}}</a>
                </td>
                <td>
                    <span>
                        <strong>{{Lang::get('attributes.currency').' '.$transaction['amount']}}</strong>
                    </span>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">{{Lang::get('messages.no_items_found')}}</td>
        </tr>
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5"><strong>Total</strong></td>

        <td>
            <span class="money-total">
                <strong>{{Lang::get('attributes.currency')}}</strong>
                {{$user->getWallet()->getTransactionsBalance()}}
            </span>
        </td>
    </tr>
    </tfoot>
</table>
