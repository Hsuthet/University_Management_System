@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Assignment</div>
                <div class="card-body">
                    <form action="{{ route('assignment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Assignment Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Department --}}
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Deadline --}}
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                            @error('deadline')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Assignment File --}}
                        <div class="mb-3">
                            <label class="form-label">Assignment File</label>
                            <input type="file" name="assignment_file" class="form-control">
                            @error('assignment_file')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('assignment.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
