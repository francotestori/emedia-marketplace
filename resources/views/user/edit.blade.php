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
                        <h3>{{Lang::get('titles.users.edit')}}</h3>
                    </div>
                    <div class="col-md-2">
                        @if(Auth::user()->isManager())
                            <a class="btn btn-primary pull-right" href="{{route('users.create')}}" >
                                {{Lang::get('forms.basic.create')}}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <br>
                {{Form::open(['route' => ['users.update',$user->id], 'class' => 'form-horizontal'])}}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {{Form::label('name', Lang::get('forms.users.name'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{Form::label('name', Lang::get('forms.users.email'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    {{Form::label('country', Lang::get('forms.users.country'), ['class' => 'control-label col-md-4'])}}
                    <div class="col-md-6">
                        <select name="country" class="form-control">
                            @foreach($countries as $key=>$value)
                                <option value="{{$key}}" @if($key == $user->country) selected @endif>
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
                    <div class="col-md-6">
                        <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info pull-left">{{Lang::get('forms.basic.update')}}</button>
                    </div>
                </div>

                {{Form::close()}}
        </div>
    </div>
@endsection
