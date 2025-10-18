@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-center py-5" style="background-color: #f8f9fa;">
    <div class="col-11 col-sm-8 col-md-5 col-lg-3">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            
            <div class="card-body p-4">
                <h4 class="text-center mb-4 text-dark fw-bold">Sign In</h4>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted small">Email Address</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               placeholder="user@university.edu">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted small">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password"
                               placeholder="••••••••">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                             Login
                        </button>
                    </div>
                </form>
            </div>

            {{-- <div class="card-footer text-center bg-light border-0 py-3">
                @if (Route::has('register'))
                    <a class="text-decoration-none small fw-semibold" href="{{ route('register') }}">
                        Need an account? Register Here
                    </a>
                @endif
            </div> --}}

        </div>
    </div>
</div>
@endsection
