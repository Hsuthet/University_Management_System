@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Notice</div>

                <div class="card-body">
                    <form action="{{ route('notices.update', $notice->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- Event Name --}}
                        <div class="mb-3">
                            <label class="form-label">Event Name</label>
                            <input type="text" name="event_name" class="form-control" value="{{ old('event_name', $notice->event_name) }}">
                            @error('event_name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $notice->description) }}</textarea>
                            @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $notice->date) }}">
                            @error('date')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Location --}}
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $notice->location) }}">
                            @error('location')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Academic Year --}}
                        <div class="mb-3">
                            <label class="form-label">Academic Year</label>
                            <select name="academic_year_id" class="form-select">
                                <option value="">Select Academic Year</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ old('academic_year_id', $notice->academic_year_id) == $year->id ? 'selected' : '' }}>
                                        {{ $year->name }} - {{ $year->semester_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('academic_year_id')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Department --}}
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id', $notice->department_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Notice Image --}}
                        <div class="mb-3">
                            <label class="form-label">Notice Image</label>
                            <input type="file" name="notice_image" class="form-control">
                            @if($notice->notice_image)
                                <img src="{{ asset('storage/'.$notice->notice_image) }}" width="100" class="mt-2">
                            @endif
                            @error('notice_image')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('notices.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
