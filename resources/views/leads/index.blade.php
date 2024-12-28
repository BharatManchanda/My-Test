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
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{route('leads.show.create.form')}}" class="btn btn-primary mb-4">Create New Lead</a>
            </div>
            <div>
                <form action="{{ route('leads.index') }}" method="GET">
                    <select class="form-select" name="type" aria-label="Filter by Type" onchange="this.form.submit()">
                        <option value="all" {{ request('type') == '' ? 'selected' : '' }}>All</option>
                        <option value="walkin" {{ request('type') == 'walkin' ? 'selected' : '' }}>Walkin</option>
                        <option value="web" {{ request('type') == 'web' ? 'selected' : '' }}>Web</option>
                        <option value="store" {{ request('type') == 'store' ? 'selected' : '' }}>Store</option>
                    </select>
                </form>
            </div>
        </div>

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
                        <td class="text-capitalize">{{ $lead->title }}</td>
                        <td>{{ $lead->contact }}</td>
                        <td>{{ $lead->email }}</td>
                        <td class="text-capitalize">{{ $lead->name }}</td>
                        <td class="text-capitalize">{{ $lead->type }}</td>
                        <td>
                            <a href="{{ route('leads.show.update.form', $lead->id) }}" title="Click to Edit lead">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:20px">
                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                </svg>
                            </a>
                            <button type="button" class="border-0" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="setDeleteLeadId('{{ $lead->id }}')" title="Click to delete lead">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width:20px">
                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($leads->isEmpty())
            <div class="alert alert-warning">
                No leads found.
            </div>
        @endif
    </div>
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center my-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="100">
                        <path stroke="red" stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <h4>Are you sure?</h4>
                    <p class="text-center px-4">This action is permanent and cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="{{ route('leads.destroy') }}">
                        @csrf
                        <input type="hidden" name="id" id="leadId">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setDeleteLeadId(leadId) {
            document.getElementById('leadId').value = leadId;
        }
    </script>

@endsection