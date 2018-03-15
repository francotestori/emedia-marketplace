<?php
$button_class = $requested != null && strtolower($requested) == strtolower($advertiser->name) ? 'anunciantes-boton' : 'editores-boton';

?>
{{Form::open(['route' => 'login', 'class' => 'formulario'])}}

@if($requested != null && strtolower($requested) == strtolower($advertiser->name))
    <img src="{{asset('img/login/anunciante.png')}}" class="img-responsive center-block">
@elseif($requested != null && strtolower($requested) == strtolower($editor->name))
    <img src="{{asset('img/login/editor.png')}}" class="img-responsive center-block">
@else
    <h3 class="center-block">{{Lang::get('titles.login')}}</h3>
@endif

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {{Form::label('email', Lang::get('forms.login.email'), ['class' => 'control-label'])}}
    {{Form::email('email', Input::old('email'), ['class' => 'form-control'])}}
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="control-label">{{Lang::get('forms.login.password')}}</label>
    <input id="password" type="password" class="form-control" name="password" required autofocus>
    @if ($errors->has('password'))
        <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
    @endif
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{Lang::get('forms.login.remember')}}
        </label>
    </div>
</div>


<div class="form-group">
    <button class="btn btn-primary boton-funciona {{$button_class}}"><strong>{{Lang::get('forms.login.execute')}}</strong></button>
    <hr>
    <a href="{{route('register', ['role' => $requested])}}" class="center-block">{{Lang::get('forms.registering')}}</a><br>
    <a href="{{route('password.request')}}" class="center-block">{{Lang::get('forms.forgotten')}}</a>
</div>

{{Form::close()}}