@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{Lang::get('titles.users.create')}}</h3>
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

        <div class="panel-heading">

            {{Form::open(['route' => 'users.store', 'class' => 'form-horizontal'])}}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {{Form::label('name', Lang::get('forms.users.name'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{Form::label('email', Lang::get('forms.users.email'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {{Form::label('password', Lang::get('forms.users.password.item'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('password-confirm', Lang::get('forms.users.password.confirm'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    {{Form::label('country', Lang::get('forms.register.country'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <select name="country" class="form-control">
                            @foreach($countries as $key=>$value)
                                <option value="{{$key}}" @if($key == old('country')) selected @endif>
                                    {{Lang::get('countries.'.$value)}}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('password-confirm', Lang::get('forms.users.role'), ['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                                @if($requested_role == $role->id)
                                    <option value="{{$role->id}}" selected>{{$role->name}} </option>
                                @else
                                    <option value="{{$role->id}}">{{$role->name}} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6">
                        <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-simple-emedia pull-left">{{Lang::get('forms.basic.create')}}</button>
                    </div>
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection
