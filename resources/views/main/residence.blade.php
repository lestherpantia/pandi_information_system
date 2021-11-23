@extends('layout.main')

@section('title')
    LGU-Pandi Resident Information System
@stop

{{--@section('header')--}}
{{--    @include('layout.header')--}}
{{--@stop--}}


@section('content')

    <div id="app">
        <residence-component></residence-component>
    </div>

@stop

@section('footer')
    @include('layout.footer')
@stop




