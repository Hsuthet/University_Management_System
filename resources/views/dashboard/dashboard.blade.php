@extends('index')

@section('content')
<div class="container-fluid py-5"> {{-- Increased vertical padding --}}

    {{-- ===== Dashboard Header ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-3"> {{-- Added divider and more margin --}}
        <h1 class="display-6 fw-bolder text-dark">Welcome to the Dashboard 👋</h1> {{-- Improved heading size and weight --}}
        <p class="text-secondary fs-5 mb-0">Hello, <span class="fw-bold text-primary">{{ Auth::user()->name }}</span>!</p>
    </div>

    {{-- ===== User Role Summary Cards ===== --}}
    <div class="row g-4 mb-5"> {{-- More spacing between rows --}}

        {{-- Card Design Principle: Modern, clean, and elevated with subtle hover effect --}}
        {{-- Card 1: Admins (Primary/Blue) --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 transform-hover"> {{-- Added transform-hover for slight animation --}}
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-square bg-primary-subtle text-primary me-4 flex-shrink-0">
                        <i class="bi bi-person-gear fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-semibold">Admins</h6>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $admins ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Teachers (Success/Green) --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 transform-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-square bg-success-subtle text-success me-4 flex-shrink-0">
                        <i class="bi bi-mortarboard fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-semibold">Teachers</h6>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $teachers ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Students (Warning/Yellow) --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 transform-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-square bg-warning-subtle text-warning me-4 flex-shrink-0">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-semibold">Students</h6>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $students ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Total Users (Secondary/Gray) --}}
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 transform-hover">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-square bg-secondary-subtle text-secondary me-4 flex-shrink-0">
                        <i class="bi bi-person-lines-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase mb-1 small fw-semibold">Total Users</h6>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $totalUsers ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

  {{-- ===== Charts Section ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-lg border-0 rounded-4 h-100"> {{-- Increased shadow for charts --}}
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">Role Distribution</h5>
                </div>
                <div class="card-body pt-0">
                    <canvas id="roleChart" height="250"></canvas> {{-- Increased height for better visibility --}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
          <div class="card shadow-lg border-0 rounded-4 h-100"> {{-- Increased shadow and ensure equal height --}}
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">User Growth Overview</h5>
                </div>
                <div class="card-body pt-0">
                    <canvas id="growthChart" height="250"></canvas> {{-- Increased height to match --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== Custom Styles for Design Improvements (Add this to your main CSS file or a <style> block) ===== --}}
<style>
/* Custom Styles for Modern Dashboard Look */
.icon-square {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 1rem; /* Adjust based on your preferred corner radius */
}

/* Subtle Hover Effect for Cards */
.transform-hover {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.transform-hover:hover {
    transform: translateY(-4px); /* Lift the card slightly */
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important; /* Enhanced shadow on hover */
}
</style>

{{-- ===== Chart.js Integration - Adjusting Colors and Styles for Cohesion ===== --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Define the color palette for cohesion
    const primaryColor = '#007bff'; // Bootstrap Primary (Blue)
    const successColor = '#28a745'; // Bootstrap Success (Green)
    const warningColor = '#ffc107'; // Bootstrap Warning (Yellow)
    const secondaryColor = '#6c757d'; // Bootstrap Secondary (Gray)

    // ✅ USER GROWTH CHART
    const growthCtx = document.getElementById('growthChart');
    if (growthCtx) {
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months ?? []) !!},
                datasets: [{
                    label: 'New Users',
                    data: {!! json_encode($growthData ?? []) !!},
                    fill: true,
                    // Adjusted colors to be more consistent with the card colors
                    backgroundColor: 'rgba(0, 123, 255, 0.1)', // Light Primary Blue fill
                    borderColor: primaryColor,
                    tension: 0.4, // Smoother curve
                    borderWidth: 3, // Slightly thicker line
                    pointBackgroundColor: primaryColor,
                    pointBorderColor: '#fff',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: secondaryColor, font: { size: 14, weight: '600' } }
                    },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' }, ticks: { color: secondaryColor } },
                    x: { grid: { display: false }, ticks: { color: secondaryColor } }
                }
            }
        });
    }

    // ✅ ROLE DISTRIBUTION CHART
    const roleCtx = document.getElementById('roleChart');
    if (roleCtx) {
        new Chart(roleCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($roleLabels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($roleData ?? []) !!},
                    // Used defined color palette for consistency
                    backgroundColor: [primaryColor, successColor, warningColor],
                    borderWidth: 4, // Thicker border for better separation
                    borderColor: '#ffffff', // White border between slices
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: secondaryColor,
                            font: { size: 14, weight: '500' },
                            padding: 20
                        }
                    },
                    tooltip: { callbacks: { label: function(context) { let label = context.label || ''; if (label) { label += ': '; } if (context.parsed !== null) { label += context.parsed + ' Users'; } return label; } } }
                }
            }
        });
    }
});
</script>
@endpush


@endsection