@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Timetable</div>

                <div class="card-body">
                   <form action="{{ route('timetable.store') }}" method="POST">
                        @csrf

                        {{-- Department --}}
                        {{-- Department --}}
                            <div class="mb-3" id="department_field">
                                <label class="form-label">Department</label>
                                <select name="department_id" class="form-select">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ old('department_id')==$dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                          {{-- Academic Year --}}
                            <div class="mb-3" id="academic_year_field">
                                <label class="form-label">Academic Year</label>
                                <select name="academic_year_id" class="form-select">
                                    <option value="">Select Year</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->id }}" {{ old('academic_year_id')==$year->id ? 'selected' : '' }}>
                                            {{ $year->name }} - {{ $year->semester_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        {{-- Teacher  --}}
                        <div class="mb-3">
                            <label class="form-label">Teacher</label>
                            <input type="text" name="teacher" class="form-control" placeholder="Enter teacher name">
                        </div>

                        {{-- Day --}}
                        <div class="mb-3">
                            <label class="form-label">Day</label>
                            <select name="day" class="form-select">
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                                <option>Friday</option>
                                <option>Saturday</option>
                            </select>
                        </div>

                        {{-- Start Time --}}
                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control">
                        </div>

                        {{-- End Time --}}
                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" name="end_time" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
