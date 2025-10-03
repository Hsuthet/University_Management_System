@extends('layouts.app') {{-- Assuming you have a main layout file --}}

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg rounded-4 border-0">
            
            <!-- Header -->
            <div class="card-header bg-primary text-white text-center py-4">
                <h4>Edit Profile</h4>
            </div>

            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profiles.update', $user['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo -->
                    <div class="mb-4 text-center">
                        <img src="{{ asset('images/profile.jpg') }}" 
                             alt="Profile Photo" class="rounded-circle mb-3 shadow-sm border" 
                             width="120" height="120">
                        <input type="file" name="profile_photo" class="form-control mt-2">
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user['name'] }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user['email'] }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user['phone'] }}">
                    </div>

                    <!-- Department -->
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" value="{{ $user['department'] }}">
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" value="{{ $user['role'] }}">
                    </div>

                    <!-- Academic Year -->
                    <div class="mb-3">
                        <label class="form-label">Academic Year</label>
                        <input type="text" name="academic_year" class="form-control" value="{{ $user['academic_year'] }}">
                    </div>

                    <!-- Age -->
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="{{ $user['age'] }}">
                    </div>

                    <!-- Father Name -->
                    <div class="mb-3">
                        <label class="form-label">Father Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ $user['father_name'] }}">
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <input type="text" name="gender" class="form-control" value="{{ $user['gender'] }}">
                    </div>

                    <!-- NRC -->
                    <div class="mb-3">
                        <label class="form-label">NRC</label>
                        <input type="text" name="nrc" class="form-control" value="{{ $user['nrc'] }}">
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('profiles.show') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
