@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12 emedia-title">
                    <div class="breadcrumbs">
                        <a href="{{route('users.show', Auth::user()->id)}}"> {{Lang::get('titles.profile')}} </a> / {{Lang::get('titles.users.password.change')}}
                    </div>
                    <h1>{{Lang::get('titles.users.password.change')}}</h1>
                </div>
            </div>
        </div>
        <br>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error_status'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_status') }}
            </div>
        @endif

        <div class="panel-heading user-pass-panel">
            {{Form::open(['route' => ['password.change', $user->id], 'class' => 'form-horizontal'])}}
                <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                    {{Form::label('old', Lang::get('forms.users.password.old'), ['class' => ''])}}                    
                    <input id="old" type="password" class="form-control" name="old" required autofocus>
                    @if ($errors->has('old'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old') }}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {{Form::label('password', Lang::get('forms.users.password.new'), ['class' => ''])}}
                    <input id="password" type="password" class="form-control" name="password" required autofocus>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {{Form::label('password_confirmation', Lang::get('forms.users.password.confirm'), ['class' => ''])}}
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group">
                    <div class="user-pass-accept">
                        <button class="btn btn-block btn-simple-emedia">{{Lang::get('forms.basic.change')}}</button>
                    </div>                   
                    <div class="user-pass-cancel">
                        <a href="{{URL::previous()}}" class="btn btn-block btn-default">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>                    
                </div>
            {{Form::close()}}

        </div>
    </div>
@endsection