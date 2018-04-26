<table class="table table-bordered" id="addspaces-table" @if(count($transactions)) data-ride="datatables" @endif>
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
                <td class="">{{$transaction['date']}}</td>
                <td>{{Lang::get('tables.'.$transaction['state'])}}</td>
                <td>
                    <a href="{{$transaction['url']}}">{{$transaction['url']}}</a>
                </td>
                <td>
                    <span>
                        <strong>{{Lang::get('attributes.currency')}}</strong>
                        {{$transaction['amount']}}
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
        <td colspan="5">Total</td>
        <td>{{$user->getWallet()->getTransactionsBalance()}}</td>
    </tr>
    </tfoot>
</table>
