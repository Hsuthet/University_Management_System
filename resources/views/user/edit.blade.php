@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="">Select Role</option>
                                <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>1 (Admin)</option>
                                <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>2 (Teacher)</option>
                                <option value="3" {{ old('role', $user->role) == '3' ? 'selected' : '' }}>3 (Student)</option>
                            </select>
                        </div>

                        {{-- Department --}}
                        <div class="mb-3" id="department_field">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id', $user->department_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Academic Year --}}
                        <div class="mb-3" id="academic_year_field">
                            <label class="form-label">Academic Year</label>
                            <select name="academic_year_id" class="form-select">
                                <option value="">Select Academic Year</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ old('academic_year_id', $user->academic_year_id) == $year->id ? 'selected' : '' }}>
                                        {{ $year->name }} - {{ $year->semester_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Roll Number --}}
                        <div class="mb-3" id="roll_number_field">
                            <label class="form-label">Roll Number</label>
                            <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number', $user->roll_number) }}">
                        </div>

                        {{-- JS: Toggle student-only fields --}}
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

                            toggleFields();
                            roleSelect.addEventListener('change', toggleFields);
                        });
                        </script>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                        </div>

                        {{-- Age --}}
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}">
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                        </div>

                        {{-- Father Name --}}
                        <div class="mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $user->father_name) }}">
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', strtolower($user->gender)) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', strtolower($user->gender)) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', strtolower($user->gender)) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        {{-- NRC --}}
                        <div class="mb-3">
                            <label class="form-label">NRC</label>
                            <input type="text" name="nrc" class="form-control" value="{{ old('nrc', $user->nrc) }}">
                        </div>

                        {{-- Profile Image --}}
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/'.$user->profile_image) }}" width="80" class="mt-2 rounded">
                            @endif
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
