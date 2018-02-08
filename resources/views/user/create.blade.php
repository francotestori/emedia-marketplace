@extends('layouts.insite-layout')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
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
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-10">
                        <h3>{{Lang::get('messages.create_users')}}</h3>
                    </div>
                    <div class="col-md-2 pull-right">
                        @if(Auth::user()->isManager())
                            <a href="{{route('package.create')}}" class="btn btn-info btn-lg">{{Lang::get('forms.create')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            <br>
                <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

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
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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
                        <label for="password" class="col-md-4 control-label">Password</label>

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
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Role</label>

                        <div class="col-md-6">
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                    @if($request_role == $role->id)
                                    <option value="{{$role->id}}" selected>{{$role->name}} </option>
                                    @else
                                    <option value="{{$role->id}}">{{$role->name}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{URL::previous()}}" class="btn btn-def">{{Lang::get('messages.cancel')}}</a>
                            <button type="submit" class="btn btn-primary">
                                {{Lang::get('messages.create')}}
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
