@extends('layout.main')

@section('title')
    Pandi Residence
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




