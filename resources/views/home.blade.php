@extends('layouts.insite-layout')

@section('content')

    @if(Auth::user()->isManager())
        @include('homeviews.admin')
    @else
        @include('homeviews.default')
    @endif
@endsection
