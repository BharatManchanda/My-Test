<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lead ? 'Edit Lead' : 'Create Lead' }}</title>
</head>
<body>
    <h1>{{ $lead ? 'Edit Lead' : 'Create New Lead' }}</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Determine the form action based on whether we're editing or creating a lead -->
    <form 
        action="{{ $lead ? route('leads.update', $lead->id) : route('leads.store') }}" 
        method="POST">
        @csrf
        @if($lead)
            @method('PUT') <!-- Use PUT method for updates -->
        @endif

        <!-- Title Field -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $lead->title ?? '') }}" required><br><br>

        <!-- Contact Field -->
        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" value="{{ old('contact', $lead->contact ?? '') }}" required><br><br>

        <!-- Email Field -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $lead->email ?? '') }}" required><br><br>

        <!-- Name Field -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $lead->name ?? '') }}" required><br><br>

        <!-- Type Field -->
        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="WEB" {{ old('type', $lead->type ?? '') == 'WEB' ? 'selected' : '' }}>WEB</option>
            <option value="WALKIN" {{ old('type', $lead->type ?? '') == 'WALKIN' ? 'selected' : '' }}>WALKIN</option>
            <option value="STORE" {{ old('type', $lead->type ?? '') == 'STORE' ? 'selected' : '' }}>STORE</option>
        </select><br><br>

        <!-- Submit Button -->
        <button type="submit">{{ $lead ? 'Update Lead' : 'Create Lead' }}</button>
    </form>

    <br><br>
    <a href="{{ route('leads.index') }}">Back to Leads List</a>
</body>
</html>
