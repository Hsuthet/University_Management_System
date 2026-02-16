@extends('index')

@section('title', $user->name . ' — Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Profile Card -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                
                <!-- Header Section -->
                <div class="card-header text-center position-relative py-5" style="background-color: #f3f4f6;">

                    {{-- Profile Image --}}
                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" 
                             alt="Profile Image" 
                             class="rounded-circle mb-3 shadow border border-3 border-white" 
                             width="150" height="150">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" 
                             alt="Default Avatar" 
                             class="rounded-circle mb-3 shadow border border-3 border-white" 
                             width="150" height="150">
                    @endif

                    {{-- Name --}}
                    <h4 class="fw-bold mb-1 text-dark">{{ $user->name }}</h4>

                    {{-- Role & Department --}}
                    <p class="text-muted mb-1">
                        {{ ucfirst($user->role_name ?? 'User') }}
                        @if ($user->department)
                            • {{ $user->department->name }}
                        @endif
                    </p>

                    {{-- Academic Year --}}
                    <p class="text-muted small mb-0">{{ $user->academicYear->name ?? 'N/A' }}</p>
                </div>

                <!-- Profile Details -->
                <div class="card-body p-4 bg-white">
                    <h5 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-person-lines-fill me-2"></i>Profile Details</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <tbody>
                                <tr>
                                    <th class="text-muted" style="width: 30%;"><i class="bi bi-envelope-fill me-2"></i>Email</th>
                                    <td>{{ $user->email ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-telephone-fill me-2"></i>Phone</th>
                                    <td>{{ $user->phone_number ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-gift-fill me-2"></i>Age</th>
                                    <td>{{ $user->age ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-person-fill me-2"></i>Father’s Name</th>
                                    <td>{{ $user->father_name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-gender-ambiguous me-2"></i>Gender</th>
                                    <td>{{ $user->gender ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted"><i class="bi bi-card-text me-2"></i>NRC</th>
                                    <td>{{ $user->nrc ?? '—' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 fw-semibold shadow-sm">
                            <i class="bi bi-arrow-left-circle me-2"></i> Back
                        </a>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styling -->
<style>
    .table th {
        width: 35%;
        font-weight: 600;
    }
    .card-header {
        background: linear-gradient(135deg, #eef2ff, #f9fafb);
    }
    .btn-outline-secondary:hover {
        background-color: #e5e7eb;
        color: #111827;
        border-color: #d1d5db;
    }
    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }
</style>
@endsection
