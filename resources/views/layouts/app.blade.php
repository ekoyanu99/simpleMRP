@extends('adminlte::page')

@section('title', $title ?? 'simpleMRP')
<link rel="icon" type="image/png" href="{{ asset('images/logo/simplemrp.png') }}">

@section('content_header')
    <h1>{{ $title ?? 'simpleMRP' }}</h1>
@stop

@section('plugins.Select2', true)
@section('plugins.Datatables', true)

@section('content')
    @yield('content')
@stop

@section('css')
    @stack('styles')
@stop

@section('js')
    @stack('scripts')
@stop
