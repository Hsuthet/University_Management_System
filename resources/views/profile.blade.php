@extends('index')

@section('title', 'User Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden" style="background-color: #f9fafb;">

            <!-- Header with pale background -->
           <div class="card-header text-center position-relative py-5" style="background-color: #e5e7eb;">

  @if (!empty($user->profile_image))
        @if (Str::startsWith($user->profile_image, 'http'))
            <img src="{{ $user->profile_image }}" 
                 alt="Profile Image" 
                 class="rounded-circle shadow-sm border" 
                 style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <img src="{{ asset('storage/' . $user->profile_image) }}" 
                 alt="Profile Image" 
                 class="rounded-circle shadow-sm border" 
                 style="width: 150px; height: 150px; object-fit: cover;">
        @endif
    @else
        <img src="{{ asset('images/default-avatar.png') }}" 
             alt="Default Avatar" 
             class="rounded-circle shadow-sm border" 
             style="width: 150px; height: 150px; object-fit: cover;">
    @endif

    {{-- Name --}}
    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>

    {{-- Role & Department --}}
    <p class="text-muted mb-0">
        {{ $user->role ?? 'User' }} 
        @if ($user->department)
            • {{ $user->department->name }}
        @endif
    </p>

    {{-- Academic Year --}}
    <p class="text-muted small">{{ $user->academic_year ?? 'N/A' }}</p>

</div>

            <!-- Profile Details Table -->
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <th class="text-muted" style="width: 30%;"><i class="bi bi-envelope-fill me-2"></i>Email</th>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted"><i class="bi bi-telephone-fill me-2"></i>Phone</th>
                                <td>{{ $user['phone_number'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted"><i class="bi bi-gift-fill me-2"></i>Age</th>
                                <td>{{ $user['age'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted"><i class="bi bi-person-fill me-2"></i>Father Name</th>
                                <td>{{ $user['father_name'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted"><i class="bi bi-gender-ambiguous me-2"></i>Gender</th>
                                <td>{{ $user['gender'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted"><i class="bi bi-card-text me-2"></i>NRC</th>
                                <td>{{ $user['nrc'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 fw-bold shadow-sm">
                        <i class="bi bi-arrow-left-circle me-2"></i>Back
                    </a>
                    <a href="{{ route('profiles.edit', 1) }}" class="btn btn-secondary px-4 fw-bold shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i>Update Profile
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Optional: Button hover styles -->
<style>
    .btn-outline-secondary:hover {
        background-color: #d1d5db;
        color: #111827;
        border-color: #9ca3af;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
        color: #111827;
    }
</style>
@endsection
