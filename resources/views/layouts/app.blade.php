@extends('adminlte::page')

@section('title', $title ?? 'simpleMRP')

@section('content_header')
    <h1>{{ $title ?? 'simpleMRP' }}</h1>
@stop

@section('plugins.Select2', true)
@section('plugins.Datatables', true)

@section('content')
    @yield('content')
@stop

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'simpleMrp') }}
        </a>
    </strong>
@stop

@section('css')
    @stack('styles')
@stop

@section('js')
    <script src="{{ asset('js/index.js') }}"></script>
    @stack('scripts')
@stop
