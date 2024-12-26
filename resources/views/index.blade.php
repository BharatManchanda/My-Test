@extends('layout')

@section('content')
    <!-- Hero Section -->
    <div class="container-fluid bg-primary text-white py-5">
        <div class="container text-center">
            <h1 class="display-4">Welcome to Laravel Application</h1>
            <p class="lead">A simple and elegant platform to manage your tasks.</p>
            <a href="{{ route('auth.show.login.form') }}" class="btn btn-light btn-lg me-3">Login</a>
            <a href="{{ route('auth.show.register.form') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Feature One</h5>
                        <p class="card-text">Description of the first feature that explains the advantage.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Feature Two</h5>
                        <p class="card-text">Description of the second feature explaining the benefits.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Feature Three</h5>
                        <p class="card-text">Description of the third feature highlighting its value.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
