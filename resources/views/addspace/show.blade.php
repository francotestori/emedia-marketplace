@extends('layouts.emedia-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>
                                    <span>
                                        <strong>Link: </strong>
                                        <a href="{{$addspace->url}}">{{$addspace->url}}</a>
                                    </span>
                                </h3>
                            </div>

                            <div class="col-lg-6">
                                <div class="pull-right">
                                    @if(Auth::user()->isEditor())
                                        <a href="{{route('addspaces.edit', $addspace->id)}}" class="btn btn-info btn-lg">Edit</a>
                                    @elseif(Auth::user()->isAdvertiser())
                                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#charge">Buy Addspace</button>
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

                    <div class="panel-body formulario">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('errors'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('errors') }}
                            </div>
                        @endif
                            <div class="row">
                                <div class="col-lg-12 pull-left">
                                    <p><strong>Description: </strong>{{$addspace->description}}</p>
                                    <p><strong>Visits: </strong>{{$addspace->visits}} per day</p>
                                    <p><strong>Cost: </strong>{{$addspace->cost}} credits</p>
                                </div>
                            </div>
                        @if(!$threads->isEmpty())
                            @include('messaging.messenger.partials.flash')

                            @each('messaging.messenger.partials.thread', $threads, 'thread', 'messaging.messenger.partials.no-threads')

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="charge" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content  alert-info">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure you want to buy the following addspace?</h4>
                </div>
                <div class="modal-body formulario">
                    <p>{{$addspace->cost.' credits will be charged'}}</p>

                    <form action="{{ route('addspaces.charge',['id' => $addspace->id]) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="subject" value="{{Lang::get('messages.query', ['user' => Auth::user()->name, 'url' => $addspace->url])}}">
                        <input type="hidden" name="recipient" value="{{$addspace->getEditor()->id}}">
                        <input type="hidden" name="reference" value="{{$addspace->id}}">

                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="btn btn-danger pull-right" data-dismiss="modal">Cancel</a>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-info pull-left">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>
@endsection
