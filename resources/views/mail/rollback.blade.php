<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <h3>Rollbacked Transactions</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table" id="addspaces-table" @if(count($transactions)) data-ride="datatables" @endif>
                <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Type</th>
                    <th>Event ID</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->getSender()->getUser()->email}}</td>
                        <td>{{$transaction->getReceiver()->getUser()->email}}</td>
                        <td>{{$transaction->type}}</td>
                        <td>{{$transaction->event_id}}</td>
                        <td>$(USD) {{$transaction->amount}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4>Reason: </h4>
            <p>{{$reason}}</p>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.scrollTo.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
</body>
</html>