@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-12">
                        <h3>
                        <span>
                            {{Lang::get('titles.new', ['item' => Lang::get('items.addspace')])}}
                        </span>
                        </h3>
                    </div>
                </div>
            </div>
            <br>

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
            @include('addspace.addspace_form',['edit'=> false])    </div>
    </div>
@endsection
