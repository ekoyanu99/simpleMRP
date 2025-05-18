@extends('layouts.app')

@section('title', 'Home')

@section('content_header', 'Home')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column">
                <h3 class="card-title mb-2" style="font-weight: 600;">Welcome, {{ auth()->user()->name }}. <span
                        class="text-muted" style="font-size: 1rem;">You are logged in as
                        {{ auth()->user()->role ?? 'user' }}.</span></h3>
            </div>
        </div>
        <div class="card-body">
            <p>simpleMRP is a simple and easy-to-use Material Requirements Planning (MRP) system.</p>
            <p>It helps you manage your inventory, production, and procurement processes efficiently.</p>
            <p>Get started by exploring the features and functionalities of simpleMRP.</p>
        </div>
    </div>
@stop

@push('styles')
@endpush

@push('scripts')
@endpush
