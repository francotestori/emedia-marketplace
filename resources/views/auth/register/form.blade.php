{{Form::open(['route' => 'register', 'class' => 'formulario'])}}

@if(strtolower($requested) == strtolower($advertiser->name))
    <img src="{{asset('img/registrarte-anunciantes.png')}}" class="img-responsive center-block">
@elseif(strtolower($requested) == strtolower($editor->name))
    <img src="{{asset('img/registrarte-editor.png')}}" class="img-responsive center-block">
@else
    <h3 class="center-block">{{Lang::get('titles.register')}}</h3>
@endif

@if (Session::has('status'))
    <div class="alert alert-info">
        {{ Session::get('status') }}
    </div>
@endif


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {{Form::label('name', Lang::get('forms.register.name'), ['class' => 'control-label'])}}
    {{Form::text('name', Input::old('name'), ['class' => 'form-control'])}}
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {{Form::label('email', Lang::get('forms.register.email'), ['class' => 'control-label'])}}
    {{Form::email('email', Input::old('email'), ['class' => 'form-control'])}}
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="control-label">{{Lang::get('forms.register.password')}}</label>
    <input id="password" type="password" class="form-control" name="password" required autofocus>
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label for="password_confirmation" class="control-label">{{Lang::get('forms.register.confirmation')}}</label>
    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    {{Form::label('country', Lang::get('forms.register.country'), ['class' => 'control-label'])}}
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

@if(strtolower($requested) == strtolower($advertiser->name))
    <input type="hidden" name="role" value="{{$advertiser->id}}">
@elseif(strtolower($requested) == strtolower($editor->name))
    <input type="hidden" name="role" value="{{$editor->id}}">
@else
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        {{Form::label('role', Lang::get('forms.register.role'), ['class' => 'control-label'])}}
        {{Form::select('role', $roles ,
        Input::old('role'), ['class' => 'form-control'])}}
        @if ($errors->has('role'))
            <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
        </span>
        @endif
    </div>
@endif

<div class="form-group">
    <button class="btn btn-primary boton-funciona editores-boton"><strong>{{Lang::get('forms.register.action')}}</strong></button>
    <hr>
    <a href="{{route('login')}}" class="center-block">{{Lang::get('forms.login.action')}}</a><br>
    <a href="{{route('password.request')}}" class="center-block">{{Lang::get('forms.forgotten')}}</a>
</div>
{{Form::open()}}

