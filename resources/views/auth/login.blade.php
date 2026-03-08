@extends('layouts.app')

@section('content')
<style>
    /* CSS Kustom untuk Tampilan yang Lebih Menarik */
    body {
        background-color: #fdfbf7; /* Warna krem lembut */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
    }

    .card-header-custom {
        background-color: #fff;
        padding: 30px 20px 10px 20px;
        text-align: center;
    }

    .logo-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }

    .brand-title {
        color: #d35400; /* Warna oranye gelap khas makanan */
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .brand-subtitle {
        color: #7f8c8d;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.2);
        border-color: #d35400;
    }

    .btn-login {
        background-color: #d35400;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-login:hover {
        background-color: #a04000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(211, 84, 0, 0.3);
    }

    .input-group-text {
        background-color: transparent;
        border: none;
        color: #d35400;
    }
    
    .input-group .form-control {
        border-left: none;
    }
    
    .input-group .input-group-text {
        border-right: none;
        border-radius: 10px 0 0 10px;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-4">
        
        <!-- Mulai Kartu Login -->
        <div class="card login-card">
            
            <!-- Bagian Header: Gambar & Tulisan -->
            <div class="card-header-custom">
                <!-- Ganti src dengan URL gambar Babi Guling asli Anda -->
                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Babi Guling" class="logo-img">
                
                <h2 class="brand-title">Warung Babi Guling</h2>
                <h5 class="brand-title">Sari Nadi</h5>
                <p class="brand-subtitle">Masakan Khas Bali Asli</p>
            </div>

            <!-- Bagian Form Login -->
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted small fw-bold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback d-block mt-1">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="form-label text-muted small fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback d-block mt-1">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-decoration-none small text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-login text-white">
                            MASUK <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer Kecil dengan Link Register -->
            <div class="card-footer text-center bg-white border-0 pb-3">
                <small class="text-muted">
                    {{ __('Don\'t have an account?') }} 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #d35400;">
                        {{ __('Register here') }}
                    </a>
                </small>
            </div>

        </div>
        <!-- Selesai Kartu Login -->

    </div>
</div>
@endsection