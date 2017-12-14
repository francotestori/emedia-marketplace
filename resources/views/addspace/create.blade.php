@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>
                                    <span>
                                        New Addspace
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
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
                            @include('addspace.addspace_form',['edit'=> false])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
