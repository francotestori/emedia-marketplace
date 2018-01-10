@if($edit)
    <div class="row">
        <div class="col-md-12">
                {{Html::ul($errors->all())}}

                {{ Form::model($addspace, array('route' => array('addspaces.update', $addspace->id), 'method' => 'PUT')) }}
                <div class="form-group">
                    {{Form::label('url', Lang::get('forms.url'))}}
                    {{Form::text('url', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', Lang::get('forms.description'))}}
                    {{Form::textarea('description', null, ['class' => 'form-control text-area'])}}
                </div>
                <div class="form-group">
                    {{Form::label('visits', Lang::get('forms.visits'))}}
                    {{Form::number('visits', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('cost', Lang::get('forms.cost'))}}
                    {{Form::number('cost', null, ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('categories[]', Lang::get('forms.categories'))}}
                    <select multiple="multiple" name="categories[]">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!--Buttons-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            {{Form::submit(Lang::get('forms.edit'), ['class' => 'btn btn-info pull-left'])}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
                {{Html::ul($errors->all())}}

                {{Form::open(['url' => 'addspaces'])}}
                <div class="form-group">
                    {{Form::label('url', Lang::get('forms.url'))}}
                    {{Form::text('url', Input::old('url'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', Lang::get('forms.description'))}}
                    {{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('visits', Lang::get('forms.visits'))}}
                    {{Form::number('visits', Input::old('visits'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('cost', Lang::get('forms.cost'))}}
                    {{Form::number('cost', Input::old('cost'), ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('categories[]', Lang::get('forms.categories'))}}
                    <select multiple="multiple" name="categories[]">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!--Buttons-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{URL::previous()}}" class="btn btn-default pull-right">{{Lang::get('forms.cancel')}}</a>
                        </div>
                        <div class="col-md-6">
                            {{Form::submit(Lang::get('forms.create'), ['class' => 'btn btn-info pull-left'])}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
        </div>
    </div>
@endif