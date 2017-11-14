@if($edit)
    <div class="row">
        <div class="col-lg-12">
            {{Html::ul($errors->all())}}

            {{ Form::model($addspace, array('route' => array('addspaces.update', $addspace->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{Form::label('url', Lang::get('messages.url'))}}
                {{Form::text('url', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', Lang::get('messages.description'))}}
                {{Form::textarea('description', null, ['class' => 'form-control text-area'])}}
            </div>
            <div class="form-group">
                {{Form::label('visits', Lang::get('messages.visits'))}}
                {{Form::number('visits', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('cost', Lang::get('messages.cost'))}}
                {{Form::number('cost', null, ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{Form::label('categories[]', Lang::get('messages.categories'))}}
                <select multiple="multiple" name="categories[]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <!--Buttons-->
            <div class="form-group">
                <a href="{{URL::previous()}}" class="btn btn-def">{{Lang::get('messages.cancel')}}</a>
                {{Form::submit(Lang::get('messages.update'), ['class' => 'btn btn-primary'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-lg-12">
            {{Html::ul($errors->all())}}

            {{Form::open(['url' => 'addspaces'])}}
            <div class="form-group">
                {{Form::label('url', Lang::get('messages.url'))}}
                {{Form::text('url', Input::old('url'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', Lang::get('messages.description'))}}
                {{Form::textarea('description', Input::old('description'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('visits', Lang::get('messages.visits'))}}
                {{Form::number('visits', Input::old('visits'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('cost', Lang::get('messages.cost'))}}
                {{Form::number('cost', Input::old('cost'), ['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{Form::label('categories[]', Lang::get('messages.categories'))}}
                <select multiple="multiple" name="categories[]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <!--Buttons-->
            <div class="form-group">
                <a href="{{URL::previous()}}" class="btn btn-def">{{Lang::get('messages.cancel')}}</a>
                {{Form::submit(Lang::get('messages.create'), ['class' => 'btn btn-primary'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@endif