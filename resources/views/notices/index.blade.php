@extends('index')

@section('content')
<div class="container">
    <div class="card">
          <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">Notice List</h5>
                        <a href="{{ route('notices.create') }}" class="btn btn-primary btn-sm">
                            + Add Notice
                        </a>
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
                        <th>Event</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th class="text-nowrap">Academic Year</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notices as $notice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $notice->event_name }}</td>
                            <td>{{ Str::limit($notice->description, 50) }}</td>
                            <td class="text-nowrap">{{ $notice->date }}</td>
                            <td>{{ $notice->location }}</td>
                            <td>
                                @if($notice->notice_image)
                                    <img src="{{ asset('storage/'.$notice->notice_image) }}" width="60">
                                @endif
                            </td>
                            <td>{{ $notice->academicYear->name ?? '-' }}</td>
                            <td>{{ $notice->department->name ?? '-' }}</td>
                             <td class="d-flex align-items-center gap-1">
                                    <!-- Edit Button -->
                                    <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-warning btn-sm d-flex align-items-center gap-1" style="padding: 0.25rem 0.5rem;">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm d-flex align-items-center gap-1" style="padding: 0.25rem 0.5rem;" onclick="return confirm('Are you sure you want to delete this notice?')">
                                            <i class="bi bi-trash3"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">No notices found</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $notices->links() }}
        </div>
    </div>
</div>
@endsection
