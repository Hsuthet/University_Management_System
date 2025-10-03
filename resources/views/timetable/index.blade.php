@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- Header --}}
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">Timetable List</h5>
                        <a href="{{ route('timetable.create') }}" class="btn btn-primary btn-sm">
                            + Add Timetable
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- DataTable --}}
                    <div class="table-responsive">
                        <table id="timetableTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Academic Year</th>
                                    <th>Teacher</th>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($timetables as $timetable)
<tr>
    <td>{{ $loop->iteration + ($timetables->currentPage() - 1) * $timetables->perPage() }}</td>
    <td>{{ $timetable->department->name ?? '-' }}</td>
    <td>{{ $timetable->academicYear->name ?? '-' }}</td>
    <td>{{ $timetable->teacher }}</td>
    <td>{{ $timetable->day }}</td>
    <td>{{ $timetable->start_time }}</td>
    <td>{{ $timetable->end_time }}</td>
    <td>
        <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i>
        </a>

        <form action="{{ route('timetable.destroy', $timetable->id) }}" 
              method="POST" class="d-inline-block"
              onsubmit="return confirm('Are you sure you want to delete this timetable?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">
                <i class="bi bi-trash3"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
        {{ $timetables->links('pagination::bootstrap-4') }}
    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- Pagination links --}}
    
@endsection

