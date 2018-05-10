@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-10 emedia-title">
                    <div class="breadcrumbs">
                        <a href="{{route('users.show', Auth::user()->id)}}"> Perfil </a> / Editar perfil
                    </div>
                    <h1>{{Lang::get('titles.users.edit')}}</h1>
                </div>
                <div class="col-md-2 emedia-title">
                    @if(Auth::user()->isManager())
                        <a class="btn btn-primary pull-right" href="{{route('users.create')}}" >
                            {{Lang::get('forms.basic.create')}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="panel-heading user-edit-panel">
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
                {{Form::open(['route' => ['users.update',$user->id], 'class' => 'form-horizontal'])}}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {{Form::label('name', Lang::get('forms.users.name'), ['class' => ''])}}                    
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif                    
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{Form::label('name', Lang::get('forms.users.email'), ['class' => ''])}}                    
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                    
                </div>

                <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                    {{Form::label('country', Lang::get('forms.users.country'), ['class' => ''])}}                    
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
                
                <div class="form-group">
                    <div class="user-edit-accept">
                        <button type="submit" class="btn btn-block btn-simple-emedia">{{Lang::get('forms.basic.update')}}</button>
                    </div>
                    <div class="user-edit-cancel">
                        <a href="{{URL::previous()}}" class="btn btn-block btn-default">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>                    
                </div>

                {{Form::close()}}
        </div>
    </div>
@endsection
