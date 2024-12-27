@extends('layout')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Leads List</h1>
            <div class="dropdown">
                <form action="{{route('auth.logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:24px; fill:#fff; margin-right:10px">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                            </svg>
                            Logout
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{route('leads.show.create.form')}}" class="btn btn-primary mb-4">Create New Lead</a>

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
                        <a href="{{ route('leads.show.update.form', $lead->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('leads.destroy') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{$lead->id}}">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection