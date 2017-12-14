@extends('layouts.emedia-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="formulario">
                        <p>You are logged in!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
