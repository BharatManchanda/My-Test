@extends('layout')

@section('content')
    <div class="container-fluid bg-primary text-white py-5 mt-5">
        <div class="container text-center">
            <h1 class="display-4">Welcome to Laravel</h1>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            @guest
                <a href="{{ route('auth.show.login.form') }}" class="btn btn-light btn-lg me-3">Login</a>
                <a href="{{ route('auth.show.register.form') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
                @else
                <p class="mt-3">Welcome back, {{ auth()->user()->name }}!</p>
                <a href="{{ route('leads.index') }}" class="btn btn-outline-light btn-lg">Go to Leads</a>
            @endguest
        </div>
    </div>
@endsection
