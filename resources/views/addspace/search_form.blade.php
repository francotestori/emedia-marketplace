<h4>{{Lang::get('messages.filter')}}</h4>
{{Form::open(['route' => 'addspaces.filter'])}}
<div class="row">
    <div class="col-md-4">
        <label for="url" class="control-label">{{Lang::get('attributes.url')}}</label>
        <input type="text" name="url" value="{{old('url')}}" class="form-control" placeholder="www.example.com">
    </div>
    <div class="col-md-4">
        <label for="visits" class="control-label">{{Lang::get('attributes.visits')}}</label>
        <input type="text" name="visits" value="{{old('visits')}}" class="form-control" placeholder="Visitas de la web">
    </div>
    <div class="col-md-4 precio">
        <label for="price" class="control-label  ">{{Lang::get('attributes.price')}}</label><br>
        <input id="ex1" name="price" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="{{old('price')}}"/>
    </div>
</div>
<div class="row">
    <!--
    <div class="col-md-4">
        <label for="name" class="control-label">{{Lang::get('attributes.name')}}</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nombre de web">
    </div>
    -->
    <div class="col-md-4">
        <label for="categories[]" class="control-label">{{Lang::get('attributes.category')}}</label>
        <select class="form-control" multiple="multiple" name="categories[]">
            @foreach(\App\Category::all() as $category)
                <option value="{{$category->name}}" @if(old('categories') != null && in_array($category->name, old('categories'))) selected @endif>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 botones">
        <br>
        <a href="#" class="btn btn-danger">{{Lang::get('messages.remove_filter')}}</a>
        <button type="submit" class="btn btn-success">{{Lang::get('messages.filter')}}</button>
    </div>
</div>
{{Form::close()}}
