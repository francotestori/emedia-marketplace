@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        {{Lang::get('titles.addspaces.create')}}
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

        <div class="panel-heading">

            {{Html::ul($errors->all())}}

            {{Form::open(['route' => 'addspaces.store', 'method' => 'post' ,'name' => 'addspace'])}}
            <div class="form-group">
                {{Form::label('url', Lang::get('forms.addspaces.item.url'))}}
                <div class="input-group">
                    <span class="input-group-addon" id="url-addon">http://</span>
                    {{Form::text('url', Input::old('url'), ['class' => 'form-control', 'placeholder' => 'http://example.com'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', Lang::get('forms.addspaces.item.description'))}}
                {{Form::textarea('description', Input::old('description'), ['class' => 'form-control', 'rows' => 4])}}
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    {{Form::label('language', Lang::get('forms.addspaces.item.language'))}}
                    <select id="language" class="form-control">
                        <option value="ES">{{Lang::get('attributes.language.ES')}}</option>
                        <option value="EN">{{Lang::get('attributes.language.EN')}}</option>
                        <option value="PT">{{Lang::get('attributes.language.PT')}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    {{Form::label('cost', Lang::get('forms.addspaces.item.price'))}}
                    <div class="input-group">
                        <span class="input-group-addon" id="cost-addon">USD</span>
                        {{Form::number('cost', Input::old('cost'), ['class' => 'form-control', 'max' => 999999, 'min' => 1, 'step' => 'any'])}}
                    </div>
                </div>
                <div class="form-group col-md-3">
                    {{Form::label('visits', Lang::get('forms.addspaces.item.visits'))}}
                    {{Form::number('visits', Input::old('visits'), ['class' => 'form-control', 'min' => 0, 'max' => 4000000000])}}
                </div>
                <div class="form-group col-md-3">
                    {{Form::label('periodicity', Lang::get('forms.addspaces.item.frequency'))}}
                    <select id="periodicity" class="form-control">
                        <option value="day">{{Lang::get('forms.addspaces.day')}}</option>
                        <option value="week">{{Lang::get('forms.addspaces.week')}}</option>
                        <option value="month">{{Lang::get('forms.addspaces.month')}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('categories[]', Lang::get('forms.addspaces.item.categories'))}}
                <select multiple="multiple" name="categories[]" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <!--Buttons-->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                    </div>
                    <div class="col-md-6">
                        {{Form::submit(Lang::get('forms.basic.create'), ['class' => 'btn btn-info pull-left'])}}
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script>
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='addspace']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    url: {
                        required: true
                    },
                    description: {
                        required: true,
                        minlength: 100
                    },
                    visits: {
                        required: true,
                        number: true,
                        min: 0,
                        max: 4000000000
                    },
                    periodicity: {
                        required: true
                    },
                    cost: {
                        required: true,
                        number: true,
                        min: 1,
                        max: 999999
                    }                },
                // Specify validation error messages
                messages: {
                    url: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.url')])}}"
                    },
                    description: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.description')])}}",
                        minlength: "{{Lang::get('validation.min.string', ['attribute' => Lang::get('forms.addspaces.item.description'), 'min' => 100])}}"
                    },
                    visits: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.visits')])}}",
                        number: "{{Lang::get('validation.url', ['attribute' => Lang::get('forms.addspaces.item.visits')])}}",
                        min: "{{Lang::get('validation.min.numeric', ['attribute' => Lang::get('forms.addspaces.item.price'), 'min' => 0])}}",
                        max: "{{Lang::get('validation.max.numeric', ['attribute' => Lang::get('forms.addspaces.item.price'), 'max' => 4000000000])}}"
                    },
                    periodicity: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.periodicity')])}}"
                    },
                    cost: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.price')])}}",
                        number: "{{Lang::get('validation.url', ['attribute' => Lang::get('forms.addspaces.item.price')])}}",
                        min: "{{Lang::get('validation.min.numeric', ['attribute' => Lang::get('forms.addspaces.item.price'), 'min' => 1])}}",
                        max: "{{Lang::get('validation.max.numeric', ['attribute' => Lang::get('forms.addspaces.item.price'), 'max' => 999999])}}"
                    }
                },
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

