<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lead ? 'Edit Lead' : 'Create Lead' }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">{{ $lead ? 'Edit Lead' : 'Create New Lead' }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ $lead ? route('leads.update') : route('leads.create') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{  $lead->id ?? '' }}">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $lead->title ?? '') }}" required>
                @error('title')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" class="form-control" value="{{ old('contact', $lead->contact ?? '') }}" required>
                @error('contact')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $lead->email ?? '') }}" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $lead->name ?? '') }}" required>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="WEB" {{ old('type', $lead->type ?? '') == 'WEB' ? 'selected' : '' }}>WEB</option>
                    <option value="WALKIN" {{ old('type', $lead->type ?? '') == 'WALKIN' ? 'selected' : '' }}>WALKIN</option>
                    <option value="STORE" {{ old('type', $lead->type ?? '') == 'STORE' ? 'selected' : '' }}>STORE</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ $lead ? 'Update Lead' : 'Create Lead' }}</button>
            </div>
        </form>

        <br>
        <a href="{{ route('leads.index') }}" class="btn btn-link">Back to Leads List</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
