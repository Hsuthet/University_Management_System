@extends('index')

@section('content')
<div class="container">
    <div class="card">
           <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">Assignment List</h5>
                         @if(Auth::user()->role == 2)
                        <a href="{{ route('assignment.create') }}" class="btn btn-primary btn-sm">
                            + Add Assignment
                        </a>
                        @endif
                    </div>
                </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Deadline</th>
                        <th>File</th>
                         @if(Auth::user()->role == 2)
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $assignment->name }}</td>
                            <td>{{ $assignment->department->name ?? '-' }}</td>
                            <td>{{ $assignment->deadline }}</td>
                            <td>
                                @if($assignment->assignment_file)
                                    <a href="{{ asset('storage/'.$assignment->assignment_file) }}" target="_blank">View</a>
                                @endif
                            </td>
                             @if(Auth::user()->role == 2)
                            <td class="d-flex gap-1">
                              <a href="{{ route('assignment.edit',$assignment->id) }}" class="btn btn-warning btn-sm text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                
                                </svg>
                               Edit
                            </a> 
                               <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                               <button class="btn btn-danger btn-sm d-flex align-items-center gap-1" style="padding: 0.25rem 0.5rem;" onclick="return confirm('Are you sure you want to delete this assignment?')">
                                            <i class="bi bi-trash3"></i>
                                            <span>Delete</span>
                                        </button> </form>

                            </td>
                             @endif
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No assignments found</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $assignments->links() }}
        </div>
    </div>
</div>
@endsection
