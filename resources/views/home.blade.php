@extends('layouts.app')

@section('title', 'Item Master')

@section('content_header', 'Item Master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Item Master Dua</h3>
        </div>
        <div class="card-body"></div>
    </div>
@stop

@push('styles')
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
@endpush

@push('scripts')
    <script>
        console.log("Item Master Loaded");
    </script>
@endpush
