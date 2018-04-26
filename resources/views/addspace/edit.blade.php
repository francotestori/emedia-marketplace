@extends('layouts.insite-layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-titulo2">
                <div class="row">
                    <div class="col-md-12">
                        <h3>
                        <span>
                            {{Lang::get('titles.addspaces.edit', ['item' => $addspace->url])}}
                        </span>
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
                <div class="alert aler  t-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <br>
            <div class="row">
                <div class="col-md-12">
                    {{Html::ul($errors->all())}}

                    {{ Form::model($addspace, array('route' => array('addspaces.update', $addspace->id), 'method' => 'PUT')) }}
                    <div class="form-group">
                        {{Form::label('url', Lang::get('forms.addspaces.item.url'))}}
                        {{Form::text('url', null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', Lang::get('forms.addspaces.item.description'))}}
                        {{Form::textarea('description', null, ['class' => 'form-control text-area'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('visits', Lang::get('forms.addspaces.item.visits'))}}
                        {{Form::number('visits', null, ['class' => 'form-control', 'min' => 0, 'max' => 4000000000])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('periodicity', Lang::get('forms.addspaces.item.frequency'))}}
                        {{Form::select('periodicity', ['day' => Lang::get('forms.addspaces.day'),
                                                       'week' => Lang::get('forms.addspaces.week'),
                                                       'month' => Lang::get('forms.addspaces.month')], ['class' => 'form-control',
                                                                                            'style' => 'display:table-cell;margin: 3px;'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('cost', Lang::get('forms.addspaces.item.price'))}}
                        {{Form::number('cost', null, ['class' => 'form-control', 'max' => 999999, 'min' => 1, 'step' => 'any'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('categories[]', Lang::get('forms.addspaces.item.categories'))}}
                        <select multiple="multiple" name="categories[]" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(in_array($category->id, $addspace_categories)) selected @endif>{{$category->name}}</option>
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
                                {{Form::submit(Lang::get('forms.basic.update'), ['class' => 'btn btn-info pull-left'])}}
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
