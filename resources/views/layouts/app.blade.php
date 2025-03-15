@extends('adminlte::page')

@section('title', $title ?? 'simpleMRP')

@section('content_header')
    <h1>{{ $title ?? 'simpleMRP' }}</h1>
@stop

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
