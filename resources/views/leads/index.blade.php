@extends('layout')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Leads List</h1>

        <!-- Success message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <a href="" class="btn btn-primary mb-4">Create New Lead</a>

        <!-- Leads Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->title }}</td>
                    <td>{{ $lead->contact }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->type }}</td>
                    <td>
                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection