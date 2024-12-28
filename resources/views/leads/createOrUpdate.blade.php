@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4">{{ $lead ? 'Edit Lead' : 'Create New Lead' }}</h4>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ $lead ? route('leads.update') : route('leads.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{  $lead->id ?? '' }}">

                                <div class="form-group mb-4">
                                    <label for="title">Title:</label>
                                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $lead->title ?? '') }}">
                                    @error('title')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="contact">Contact:</label>
                                    <input type="text" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact', $lead->contact ?? '') }}">
                                    @error('contact')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $lead->email ?? '') }}">
                                    @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $lead->name ?? '') }}">
                                    @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="type">Type:</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="web" {{ old('type', $lead->type ?? '') == 'web' ? 'selected' : '' }}>Web</option>
                                        <option value="walkin" {{ old('type', $lead->type ?? '') == 'walkin' ? 'selected' : '' }}>Walkin</option>
                                        <option value="store" {{ old('type', $lead->type ?? '') == 'store' ? 'selected' : '' }}>Store</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 py-2">{{ $lead ? 'Update Lead' : 'Create Lead' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{ route('leads.index') }}" class="btn btn-link">Back to Leads List</a>
            </div>
        </div>
    <br>
    </div>
@endsection
