@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Academic Year Create</div>

                <div class="card-body">
                  
                    <form action="{{ route('academicyear.store') }}" method="post">
                        @csrf  

                        {{-- Academic Year Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Academic Year Name</label>
                            <input type="text" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Semester Name --}}
                        <div class="mb-3">
                            <label for="semester_name" class="form-label">Semester Name</label>
                            <input type="text" name="semester_name" 
                                   class="form-control @error('semester_name') is-invalid @enderror" 
                                   id="semester_name" value="{{ old('semester_name') }}">
                            @error('semester_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('academicyear.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
