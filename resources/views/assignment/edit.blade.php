@extends('index')

@section('content')
<div class="container">

    {{-- Flash message --}}
    <x-flash-message message="success" type="success"/>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Assignment</div>
                <div class="card-body">
                    <form action="{{ route('assignment.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Assignment Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $assignment->name) }}">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Department --}}
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id', $assignment->department_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Deadline --}}
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $assignment->deadline) }}">
                            @error('deadline')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Assignment File --}}
                        <div class="mb-3">
                            <label class="form-label">Assignment File</label>
                            <input type="file" name="assignment_file" class="form-control">
                            @if($assignment->assignment_file)
                                <p class="mt-2">Current File: 
                                    <a href="{{ asset('storage/'.$assignment->assignment_file) }}" target="_blank">
                                        {{ basename($assignment->assignment_file) }}
                                    </a>
                                </p>
                            @endif
                            @error('assignment_file')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('assignment.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
