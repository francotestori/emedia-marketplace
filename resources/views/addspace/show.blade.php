@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>
                                    <strong>Link: </strong>
                                    <a href="{{$addspace->url}}">{{$addspace->url}}</a>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    @if(Auth::user()->isEditor())
                                    <a href="{{route('addspaces.edit', $addspace->id)}}" class="btn btn-info">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>
                                    @foreach($addspace->getCategories() as $category)
                                        <span class="label label-primary">{{$category->name}}</span>
                                    @endforeach
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12 alert-info">
                                <h4>Details</h4>
                            </div>
                            <hr>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 alert-success">
                                <p><strong>Description: </strong>{{$addspace->description}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 alert-success">
                                <p><strong>Visits: </strong>{{$addspace->visits}} per day</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 alert-success">
                                <p><strong>Cost: </strong>{{$addspace->cost}} credits</p>
                            </div>
                        </div>

                        <br>
                        <br>

                        <div class="row">
                            <div class="col-lg-12">
                                @if($threads->isEmpty() && Auth::user()->isAdvertiser())
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#message">Message</button>
                                    <div id="message" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Modal Header</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h1>Create a new message</h1>
                                                    <form action="{{ route('messages.store') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="subject" value="{{Lang::get('messages.query', ['user' => Auth::user()->name, 'url' => $addspace->url])}}">
                                                        <input type="hidden" name="recipient" value="{{$addspace->getEditor()->id}}">
                                                        <input type="hidden" name="reference" value="{{$addspace->id}}">

                                                        <!-- Message Form Input -->
                                                        <div class="form-group">
                                                            <label class="control-label">Message</label>
                                                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                                                        </div>

                                                        <!-- Submit Form Input -->
                                                        <div class="form-group">
                                                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                 @else
                                    @include('messaging.messenger.partials.flash')

                                    @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
