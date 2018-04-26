{{Form::open(['route' => 'addspaces.filter'])}}
<div class="row">
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon" id="url-addon">http://</span>
            <input type="text" name="url" value="{{old('url')}}" class="form-control" placeholder="www.example.com">
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <span class="input-group-addon" id="url-addon">{{Lang::get('forms.addspaces.search.frequency')}}</span>
            <select class="form-control" name="frequency">
                <option value="day">{{Lang::get('forms.addspaces.day')}}</option>
                <option value="week">{{Lang::get('forms.addspaces.week')}}</option>
                <option value="month">{{Lang::get('forms.addspaces.month')}}</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label for="visits" class="control-label">{{Lang::get('forms.addspaces.search.visits')}}</label>
        <br>
        <br>
        <br>
        <input id="visitSlider" name="visits" data-slider-id='visitSlider' type="text"
               data-slider-min="0" data-slider-max="5000" data-slider-step="1" data-slider-value="{{'['.old('visits','0, 500').']'}}"/>
    </div>
    <div class="col-md-3">
        <label for="price" class="control-label">{{Lang::get('forms.addspaces.search.price')}}</label>
        <br>
        <br>
        <br>
        <input class="form-control" id="priceSlider" name="price" data-slider-id='priceSlider' type="text"
               data-slider-min="0" data-slider-max="5000" data-slider-step="1" data-slider-value="{{'['.old('price','0, 500').']'}}"/>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-4">
        <select class="form-control" multiple="multiple" name="categories[]">
            @foreach($search_categories as $category)
                <option value="{{$category->name}}"
                        @if(in_array($category->name, old('categories',[]))) selected @endif>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="order" class="control-label">{{Lang::get('forms.addspaces.search.order')}}</label>
        <br>
        <input type="checkbox" name="order" id="order" checked data-toggle="toggle" data-on="ASC" data-off="DESC">
    </div>
</div>
<br>
<div class="row">
    <br>
    <div class="col-md-4 botones">
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('addspaces.index')}}" class="pull-left">{{Lang::get('forms.addspaces.search.remove')}}</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-block btn-simple-emedia pull-right">{{Lang::get('forms.addspaces.search.filter')}}</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    </div>
</div>
{{Form::close()}}
