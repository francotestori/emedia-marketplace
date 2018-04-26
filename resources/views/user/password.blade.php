@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <h1>{{Lang::get('titles.users.password.change')}}</h1>
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

        <div class="panel-heading">
            {{Form::open(['route' => ['password.change', $user->id], 'class' => 'form-horizontal'])}}
                <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                    {{Form::label('old', Lang::get('forms.users.password.old'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <input id="old" type="password" class="form-control" name="old" required autofocus>
                        @if ($errors->has('old'))
                            <span class="help-block">
                                <strong>{{ $errors->first('old') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {{Form::label('password', Lang::get('forms.users.password.new'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required autofocus>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {{Form::label('password_confirmation', Lang::get('forms.users.password.confirm'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{URL::previous()}}" class="btn btn-block btn-default">{{Lang::get('forms.basic.cancel')}}</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-block btn-simple-emedia"><strong>{{Lang::get('forms.basic.change')}}</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            {{Form::close()}}

        </div>
    </div>
@endsection