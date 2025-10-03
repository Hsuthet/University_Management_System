@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Academic Year Update</div>

                <div class="card-body">
                    <form action="{{ route('academicyear.update', $academicYear->id) }}" method="post">
                        @csrf  
                        @method('put')

                        {{-- Academic Year Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Academic Year Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{ old('name', $academicYear->name) }}" required>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Semester Name --}}
                        <div class="mb-3">
                            <label for="semester_name" class="form-label">Semester Name</label>
                            <input type="text" name="semester_name" class="form-control" id="semester_name"
                                   value="{{ old('semester_name', $academicYear->semester_name) }}" required>
                            @error('semester_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('academicyear.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
