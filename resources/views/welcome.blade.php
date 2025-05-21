@extends('layouts.guest')

@section('title', 'Welcome to simpleMRP')

@section('content')
    <div class="text-center py-5">
        <h1 class="mb-4">Welcome to simpleMRP</h1>
        <p class="lead mb-4">
            A simple Material Requirements Planning system for efficient inventory and production management.
        </p>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </a>

        <div class="mt-4 text-muted">
            <small>Don't have an account? <a href="{{ route('register') }}">Register here</a></small>
        </div>
    </div>
@endsection
