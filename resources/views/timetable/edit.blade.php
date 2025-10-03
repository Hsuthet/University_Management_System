@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Timetable Entry</div>

                <div class="card-body">
                    <form action="{{ route('timetable.update', $timetable->id) }}" method="post">
                        @csrf
                        @method('put')

                        {{-- Teacher --}}
                        <div class="mb-3">
                            <label class="form-label">Teacher</label>
                            <input type="text" name="teacher" class="form-control" value="{{ old('teacher', $timetable->teacher) }}">
                            @error('teacher')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Day --}}
                        <div class="mb-3">
                            <label class="form-label">Day</label>
                            <select name="day" class="form-select">
                                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                                    <option value="{{ $day }}" {{ old('day', $timetable->day) == $day ? 'selected' : '' }}>
                                        {{ $day }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Start Time --}}
                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $timetable->start_time) }}">
                            @error('start_time')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- End Time --}}
                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $timetable->end_time) }}">
                            @error('end_time')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Academic Year --}}
                        <div class="mb-3">
                            <label class="form-label">Academic Year</label>
                            <select name="academic_year_id" class="form-select">
                                <option value="">Select Academic Year</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ old('academic_year_id', $timetable->academic_year_id) == $year->id ? 'selected' : '' }}>
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
                                    <option value="{{ $dept->id }}" {{ old('department_id', $timetable->department_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('timetable.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

