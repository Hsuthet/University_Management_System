@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        </div>

                        {{-- Role --}}
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="1" {{ old('role')=='1' ? 'selected' : '' }}>1 (for admin)</option>
                                    <option value="2" {{ old('role')=='2' ? 'selected' : '' }}>2 (for teacher)</option>
                                    <option value="3" {{ old('role')=='3' ? 'selected' : '' }}>3  (for student)</option>
                                </select>
                            </div>

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

                            {{-- Roll Number --}}
                            <div class="mb-3" id="roll_number_field">
                                <label class="form-label">Roll Number</label>
                                <input type="text" name="roll_number" value="{{ old('roll_number') }}" class="form-control">
                            </div>

                            {{-- JavaScript to toggle fields --}}
                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const roleSelect = document.getElementById('role');
                                const departmentField = document.getElementById('department_field');
                                const academicYearField = document.getElementById('academic_year_field');
                                const rollNumberField = document.getElementById('roll_number_field');

                                function toggleFields() {
                                    if (roleSelect.value === '3') {
                                        departmentField.style.display = '';
                                        academicYearField.style.display = '';
                                        rollNumberField.style.display = '';
                                    } else {
                                        departmentField.style.display = 'none';
                                        academicYearField.style.display = 'none';
                                        rollNumberField.style.display = 'none';
                                    }
                                }

                                // Initial toggle on page load
                                toggleFields();

                                // Toggle on change
                                roleSelect.addEventListener('change', toggleFields);
                            });
                            </script>

                                              {{-- Phone Number --}}
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
                        </div>

                        {{-- Age --}}
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" value="{{ old('age') }}" class="form-control">
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                        </div>

                       

                        {{-- Father Name --}}
                        <div class="mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" class="form-control" autocomplete="off">

                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                                <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                                <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                            </select>
                        </div>

                        {{-- NRC --}}
                        <div class="mb-3">
                            <label class="form-label">NRC</label>
                            <input type="text" name="nrc" value="{{ old('nrc') }}" class="form-control">
                        </div>

                        {{-- Profile Image --}}
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>

                        <button class="btn btn-primary">Create</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
