<h4>{{Lang::get('messages.filter')}}</h4>
{{Form::open(['route' => 'addspaces.filter'])}}
<div class="row">
    <div class="col-md-4">
        <label for="url" class="control-label">{{Lang::get('forms.addspaces.search.url')}}</label>
        <input type="text" name="url" value="{{old('url')}}" class="form-control" placeholder="www.example.com">
    </div>
    <div class="col-md-4">
        <label for="visits" class="control-label">{{Lang::get('forms.addspaces.search.visits')}}</label>
        <input type="text" name="visits" value="{{old('visits')}}" class="form-control" placeholder="Visitas de la web">
    </div>
    <div class="col-md-4 precio">
        <label for="price" class="control-label  ">{{Lang::get('forms.addspaces.search.price')}}</label><br>
        <input id="ex1" name="price" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="{{old('price', 0)}}"/>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="categories[]" class="control-label">{{Lang::get('forms.addspaces.search.categories')}}</label>
        <select class="form-control" multiple="multiple" name="categories[]">
            @foreach(\App\Category::orderBy('name', 'asc')->get() as $category)
                <option value="{{$category->name}}"
                    @if(in_array($category->name, old('categories',[]))) selected @endif>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 botones">
        <br>
        <a href="{{route('addspaces.search')}}" class="btn btn-danger">{{Lang::get('forms.addspaces.search.remove')}}</a>
        <button type="submit" class="btn btn-success">{{Lang::get('forms.addspaces.search.filter')}}</button>
    </div>
</div>
{{Form::close()}}
