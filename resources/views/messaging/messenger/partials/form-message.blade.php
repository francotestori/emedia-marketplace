<h4>{{Lang::get('messages.new_message')}}</h4>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
    </div>

    <!-- Submit Form Input -->
    <div class="form-group">
        <div class="row">
            <div class="col-lg-6">
                <a href="{{route('messages')}}" class="btn btn-default pull-right">{{Lang::get('forms.cancel')}}</a>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-info pull-left">{{Lang::get('forms.post')}}</button>
            </div>
        </div>
    </div>
</form>