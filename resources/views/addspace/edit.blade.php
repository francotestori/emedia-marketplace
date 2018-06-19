@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default web-edit-panel">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12 emedia-title">
                    <div class="breadcrumbs">
                        <a href="{{route('addspaces.index')}}"> Mis Webs </a> /
                        <a href="{{$addspace->url}}"> {{$addspace->url}} </a> / Edit
                    </div>
                    <!--, ['item' =>"{{$addspace->url}}"] ESTO NO ESTABA HACIENDO DIFERENCIA-->
                    <h1>
                        {{Lang::get('titles.addspaces.edit')}} >
                        <a class="title-link" href="{{$addspace->url}}"> {{$addspace->url}} </a>                   
                    </h1>
                </div>
            </div>
        </div>
        <br>

        <div class="panel-heading">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('errors'))
                <div class="alert aler  t-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <br>
            <div class="clearfix">
                <div class="col-md-12">
                    {{Html::ul($errors->all())}}

                    {{ Form::model($addspace, array('route' => array('addspaces.update', $addspace->id), 'method' => 'PUT', 'name' => 'addspace')) }}
                    <div class="form-group">
                        {{Form::label('url', Lang::get('forms.addspaces.item.url'))}}
                        <div class="input-group">
                                <span class="input-group-addon" id="cost-addon">http://</span>
                            {{Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'http://example.com'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('description', Lang::get('forms.addspaces.item.description'))}}
                        {{Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4])}}
                    </div>

                    <div class="form-">
                        <!--<div class="form-group col-md-3">
                            {{Form::label('language', Lang::get('forms.addspaces.item.language'))}}
                            <select id="language" class="form-control">
                                <option value="ES">{{Lang::get('attributes.language.ES')}}</option>
                                <option value="EN">{{Lang::get('attributes.language.EN')}}</option>
                                <option value="PT">{{Lang::get('attributes.language.PT')}}</option>
                            </select>
                        </div>-->
                        <div class="form-group col-md-6">
                            {{Form::label('cost', Lang::get('forms.addspaces.item.price'))}}
                            <div class="input-group limit-size-md">
                                <span class="input-group-addon" id="cost-addon">USD</span>
                                {{Form::number('cost', null, ['class' => 'form-control', 'max' => 999999, 'min' => 1, 'step' => 'any'])}}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('visits', Lang::get('forms.addspaces.item.visits'))}}
                            <div class="limit-size-md">
                            {{Form::number('visits', null, ['class' => 'form-control', 'min' => 0, 'max' => 4000000000])}}
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            {{Form::label('periodicity', Lang::get('forms.addspaces.item.frequency'))}}
                            <input type="text" id="periodicity" name="periodicity" class="form-control" value="month">
                            <!--<select id="periodicity" class="form-control">                                
                                <option value="day">{{Lang::get('forms.addspaces.day')}}</option>
                                <option value="week">{{Lang::get('forms.addspaces.week')}}</option>
                                <option value="month" selected>{{Lang::get('forms.addspaces.month')}}</option>
                            </select>-->
                        </div>
                    </div>
                    <div class="form-group col-md-8 web-edit-categ">
                        {{Form::label('categories[]', Lang::get('forms.addspaces.item.categories'))}}
                        <select multiple="multiple" name="categories[]" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"@if(in_array($category->id, $addspace_categories)) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--Buttons-->
                    <div class="form-group col-md-4 web-edit-btns">                        
                        <!--<div class="web-edit-cancel">
                            <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.basic.cancel')}}</a>
                        </div>-->
                        <div class="web-edit-accept">
                            {{Form::submit(Lang::get('forms.basic.update'), ['class' => 'btn btn-info pull-left'])}}
                        </div>                        
                    </div>                    
                    {{Form::close()}}
                </div>
            </div>
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
                        required: true,
                        url: true
                    },
                    description: {
                        required: true,
                        minlength: 100,
                        maxlength: 800
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
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.url')])}}",
                        url: "{{Lang::get('validation.url', ['attribute' => Lang::get('forms.addspaces.item.url')]).'( http://example.com )'}}"
                    },
                    description: {
                        required: "{{Lang::get('validation.required', ['attribute' => Lang::get('forms.addspaces.item.description')])}}",
                        minlength: "{{Lang::get('validation.min.string', ['attribute' => Lang::get('forms.addspaces.item.description'), 'min' => 100])}}",
                        maxlength: "{{Lang::get('validation.max.string', ['attribute' => Lang::get('forms.addspaces.item.description'), 'max' => 800])}}"
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
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
