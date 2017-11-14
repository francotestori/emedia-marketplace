@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Users</span>
                            </div>
                            <div class="col-lg-6">
                                @if(Auth::user()->isManager())
                                    <div class="pull-right">
                                        <a href="{{route('users.create')}}" class="btn btn-info">{{Lang::get('messages.create_users')}}</a>
                                    </div>
                                @endif
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
                            <div class="col-lg-12">
                                <ul>
                                    @foreach($users as $user)
                                    <li>
                                        <span>
                                        {{$user->id}} -<a href="{{route('users.show',$user->id)}}">{{$user->name.' - '.$user->email.' - role:'.$user->role()->first()->name}}</a>
                                        </span>

                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
