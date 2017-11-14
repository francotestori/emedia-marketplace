@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        Addspace Index!

                        @include('addspace.addspace_form', ['edit' => true, 'addspace' => $addspace])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
