@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-center" 
     style="background-color: var(--bg-body); transition: all 0.3s ease;">
     
    <div class="col-11 col-sm-8 col-md-4 col-lg-3">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden" 
             style="background-color: var(--card-bg); color: var(--card-text); transition: all 0.3s ease;">
             
            {{-- Brand / Logo --}}
            <div class="text-center py-3 bg-opacity-10" style="background-color: var(--sidebar-bg);">
                <img src="{{ asset('dist/assets/img/12535246.png') }}" 
                     alt="Logo" 
                     class="mb-2" 
                     style="width: 50px; height: 50px; object-fit: contain;">
                <h5 class="fw-bold mb-0" style="color: #f5b301;">University Management</h5>
            </div>

            <div class="card-body px-4 py-4">
                <h5 class="text-center mb-4 fw-semibold" style="color: var(--text-color);">Sign In</h5>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-medium" style="color: var(--text-color);">Email Address</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="user@university.edu" 
                               style="border-color: var(--sidebar-active-bg);">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-medium" style="color: var(--text-color);">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password"
                               placeholder="••••••••" 
                               style="border-color: var(--sidebar-active-bg);">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Login Button --}}
                    <div class="d-grid">
                        <button type="submit" 
                                class="btn btn-lg rounded-3 fw-semibold btn-login">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- Custom Button CSS --}}
<style>
.btn-login {
    background-color: #f5b301;
    color: #0b1a33;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.btn-login:hover {
    background-color: #ffd65a;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.25);
}
</style>
@endsection
