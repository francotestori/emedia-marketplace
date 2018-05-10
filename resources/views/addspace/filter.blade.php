<div>
    @foreach($selected_categories as $category)
        <span style="display: inline-block; margin-top: 10px;">
        <a class="btn btn-warning disabled">
           <span>{{$category->name}}</span>
        </a>
    </span>
    @endforeach
</div>
<br>
{{Form::open(['route' => 'addspaces.indexFilter'])}}
<input type="hidden" name="status" value="{{app('request')->input('status')}}">
<div class="row">
    <div class="col-md-6">
        <select class="form-control" multiple="multiple" name="categories[]">
            @foreach(\App\Category::orderBy('name', 'asc')->get() as $category)
                <option value="{{$category->name}}"
                        @if($selected_categories->contains($category))) selected @endif>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="btn-block pull-right">
            <div class="input-group">
                <span class="input-group-addon" id="url-addon">{{Lang::get('tables.status')}}</span>
                <select class="form-control" name="status">
                    <option value="">{{Lang::get('tables.all')}}</option>
                    <option value="ACTIVE" @if(old('status') == 'ACTIVE') selected @endif>{{Lang::get('tables.active')}}</option>
                    <option value="PAUSED" @if(old('status') == 'PAUSED') selected @endif>{{Lang::get('tables.paused')}}</option>
                    <option value="CLOSED" @if(old('status') == 'CLOSED') selected @endif>{{Lang::get('tables.closed')}}</option>
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <br>
    <div class="col-md-6 botones">
        <a href="{{route('addspaces.index')}}" class="pull-left">{{Lang::get('forms.addspaces.search.remove')}}</a>
        <!-- btn-simple-emedia -->
        <button type="submit" class="btn btn-invert-emedia pull-right">{{Lang::get('forms.addspaces.search.filter')}}</button>
    </div>
    <div class="col-md-6">
    </div>
</div>
{{Form::close()}}
