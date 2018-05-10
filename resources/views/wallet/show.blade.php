@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-8 emedia-title">
                    <h1 class="heading">{{Lang::get('titles.wallet.index')}}</h1>
                    <p class="subheading">{{Lang::get('messages.wallet.tuft')}}</p>
                </div>
                <div class="col-md-4 pull-right emedia-title">
                    @if(Auth::user()->isEditor())
                        <button data-toggle="modal" data-target="#withdrawModal" class="btn btn-block btn-emedia absolute-right">{{Lang::get('forms.basic.withdraw')}}</button>
                    @elseif(Auth::user()->isAdvertiser())
                        <a href="{{route('deposit')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.deposit')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <br>

        <div class="panel-heading">
            @if (session('status'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif            
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
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script>
        $(function() {
            $("#withdrawErrorMessage").hide();
            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='withdrawal']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    paypal: {
                        required: true
                    },
                    amount: {
                        required: true
                    },
                    cbu: {
                        required: true
                    },
                    alias: {
                        required: true
                    },
                    comment: {
                        required: true
                    }
                },
                // Specify validation error messages
                messages: {
                    paypal: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.withdrawals.paypal')])}}"
                    },
                    amount: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.withdrawals.amount')])}}"
                    },
                    cbu: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.withdrawals.cbu')])}}"
                    },
                    alias: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.withdrawals.alias')])}}"
                    },
                    comment: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.withdrawals.reason')])}}"
                    }
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{route('withdraw')}}",
                        type: "POST",
                        data: $(form).serialize(),
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if(response.status){
                                $('#loading').hide();
                                $("#withdrawModal").modal('hide');
                                var url = window.location.href;
                                if (url.indexOf('?') > -1)
                                    url += 'status=' + response.data;
                                else
                                    url += '?status=' + response.data;
                                window.location.href = url;
                            }
                            else{
                                $('#loading').hide();
                                $("#withdrawErrorMessage").show();
                                $("#withdrawErrorMessage").text(response.data);
                            }
                        }                    });
                    return false;
                }
            });
        });
    </script>

@endsection