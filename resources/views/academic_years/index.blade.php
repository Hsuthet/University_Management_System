@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">Academic Year List</h5>
                        <a href="{{ route('academicyear.create') }}" class="btn btn-primary btn-sm">
                            + Add Academic Year
                        </a>
                    </div>
                </div>

                <div class="card-body">
                 <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Academic Year</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($academicYears as $year)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $year->name }}</td>
                            <td>{{ $year->semester_name }}</td>
                            <td class="d-flex align-items-center gap-1">
                                <!-- Edit Button -->
                                <a href="{{ route('academicyear.edit', $year->id) }}" class="btn btn-warning btn-sm p-1">
                                    <i class="bi bi-pencil-square">Edit</i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('academicyear.destroy', $year->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm p-1" onclick="return confirm('Are you sure you want to delete this academic year?')">
                                        <i class="bi bi-trash3">Delete</i>
                                    </button>
                                </form>
                            </td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                 </table>

                 {{-- Pagination --}}
                 <div>
                     {{ $academicYears->links() }}
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
