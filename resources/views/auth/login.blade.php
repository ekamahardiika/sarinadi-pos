@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: #fff3ec;
            --dark: #1a1008;
            --dark-2: #2d1a06;
            --text-light: #8c7060;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* Background decoration */
        .auth-bg {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .auth-bg::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-bg::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(211, 84, 0, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Deco icons */
        .deco-icon {
            position: absolute;
            opacity: 0.04;
            color: white;
            pointer-events: none;
            font-size: 160px;
        }

        .deco-1 {
            top: 5%;
            left: 3%;
            transform: rotate(-15deg);
        }

        .deco-2 {
            bottom: 5%;
            right: 3%;
            transform: rotate(20deg);
            font-size: 100px;
            color: var(--orange);
            opacity: 0.07;
        }

        /* Card */
        .auth-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(211, 84, 0, 0.2);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
        }

        /* Card header */
        .auth-card-header {
            padding: 36px 36px 24px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .auth-logo {
            width: 56px;
            height: 56px;
            background: var(--orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
            margin: 0 auto 16px;
            box-shadow: 0 8px 25px rgba(211, 84, 0, 0.4);
        }

        .auth-logo img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .auth-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .auth-brand span {
            color: var(--orange);
        }

        .auth-subtitle {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 0.05em;
        }

        /* Card body */
        .auth-card-body {
            padding: 28px 36px 32px;
        }

        .auth-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 6px;
        }

        .auth-title em {
            color: var(--orange);
            font-style: italic;
        }

        .auth-desc {
            font-size: 0.83rem;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 28px;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--orange);
            font-size: 0.85rem;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 40px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.25s;
            outline: none;
            box-sizing: border-box;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-control:focus {
            border-color: var(--orange);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.15);
            color: white; /* pastikan teks tetap putih */
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.78rem;
            margin-top: 6px;
            display: block;
        }

        /* Remember & Forgot */
        .form-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            accent-color: var(--orange);
            cursor: pointer;
        }

        .form-check-label {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.45);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--orange);
        }

        /* Submit button */
        .btn-auth {
            width: 100%;
            padding: 13px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.35);
        }

        .btn-auth:hover {
            background: var(--orange-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(211, 84, 0, 0.5);
        }

        /* Card footer */
        .auth-card-footer {
            padding: 18px 36px 24px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .auth-card-footer p {
            font-size: 0.83rem;
            color: rgba(255, 255, 255, 0.35);
            margin: 0;
        }

        .auth-card-footer a {
            color: var(--orange);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-card-footer a:hover {
            color: var(--orange-light);
        }

        /* Back to home link */
        .back-home {
            position: absolute;
            top: 28px;
            left: 32px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            font-size: 0.83rem;
            font-weight: 500;
            transition: color 0.2s;
            z-index: 10;
        }

        .back-home:hover {
            color: var(--orange);
        }

        /* Stats mini */
        .auth-stats {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-top: 24px;
        }

        .auth-stat {
            text-align: center;
        }

        .auth-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--orange);
            display: block;
            line-height: 1;
        }

        .auth-stat-lbl {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .auth-stat-divider {
            width: 1px;
            background: rgba(255, 255, 255, 0.08);
            align-self: stretch;
        }
    </style>

    <div class="auth-bg">
        <!-- Deco -->
        {{-- <i class="fas fa-leaf deco-icon deco-1"></i>
        <i class="fas fa-pepper-hot deco-icon deco-2"></i> --}}

        <!-- Back to home -->
        <a href="/" class="back-home">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="auth-card">

            <!-- Header -->
            <div class="auth-card-header">
                <div class="auth-logo"><img src="{{ asset('image/logo_sari_nadi_transparent.png') }}" alt="Logo"></div>
                <div class="auth-brand">Sari <span>Nadi</span></div>
                <div class="auth-subtitle">Warung Babi Guling Khas Bali</div>
            </div>

            <!-- Body -->
            <div class="auth-card-body">
                <h2 class="auth-title">Selamat <em>Datang</em> Kembali</h2>
                <p class="auth-desc">Masuk ke akun Anda untuk melanjutkan</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope input-icon"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="nama@email.com">
                            @error('email')
                                <span class="invalid-feedback"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="form-footer-row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-auth">
                        Masuk <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="auth-card-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
