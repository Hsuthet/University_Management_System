@extends('index')

@section('content')

<style>
    /* Green highlight style */
    .highlight-green {
        background-color: #a3e635; /* light green */
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">Department List</h5>

                        <!-- Search Bar -->
                        <form action="{{ route('department.index') }}" method="GET" class="d-flex me-2">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-control form-control-sm me-2" 
                                   placeholder="Search Department...">
                            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                        </form>

                        <a href="{{ route('department.create') }}" class="btn btn-primary btn-sm">
                            + Add Department
                        </a>
                    </div>
                </div>

                <!-- Department Table -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Content</th>
                             @if(Auth::user()->role == 1)
                            <th>Action</th>
                             @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // helper function for highlighting text in green
                            function highlight($text, $search) {
                                if (!$search) return $text;
                                return preg_replace(
                                    "/(" . preg_quote($search, '/') . ")/i",
                                    '<span class="highlight-green">$1</span>',
                                    $text
                                );
                            }
                        @endphp

                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{!! highlight($department->name, request('search')) !!}</td>
                            <td>{!! highlight($department->content, request('search')) !!}</td>
                            <td class="d-flex align-items-center gap-1">

                                <!-- Edit Button -->
                                <a href="{{ route('department.edit', $department->id) }}" 
                                   class="btn btn-warning btn-sm d-flex align-items-center gap-1" 
                                   style="padding: 0.25rem 0.5rem;">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>Edit</span>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('department.destroy', $department->id) }}" 
                                      method="POST" 
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm d-flex align-items-center gap-1" 
                                            style="padding: 0.25rem 0.5rem;" 
                                            onclick="return confirm('Are you sure you want to delete this department?')">
                                        <i class="bi bi-trash3"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-2">
                    {{ $departments->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
