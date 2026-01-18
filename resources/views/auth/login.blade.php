@extends('layouts.app')

@section('content')
<style>
    /* 1. Sembunyikan Navbar bawaan supaya Login Full Screen & Keren */
    nav.navbar {
        display: none !important;
    }
    
    /* Reset Padding Main dari Layout */
    main.py-4 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    /* 2. Style Layout Split Screen */
    .login-wrapper {
        min-height: 100vh;
        width: 100vw;
        overflow-x: hidden;
    }

    /* Sisi Kiri (Gambar) */
    .bg-image-side {
        /* Ganti URL ini kalau mau gambar lain */
        background-image: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1470&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    /* Overlay Gelap Transparan di atas gambar */
    .bg-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.9), rgba(0, 0, 0, 0.7));
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem;
        color: white;
    }

    /* Sisi Kanan (Form) */
    .form-side {
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .login-card-custom {
        width: 100%;
        max-width: 420px;
    }

    /* Styling Input supaya lebih modern */
    .form-control-lg {
        border-radius: 10px;
        font-size: 0.95rem;
        padding: 0.8rem 1rem;
        border: 1px solid #e1e1e1;
        background-color: #f8f9fa;
    }
    
    .form-control-lg:focus {
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        border-color: #0d6efd;
    }

    /* Tombol Login */
    .btn-login {
        border-radius: 10px;
        padding: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
</style>

<div class="container-fluid p-0 login-wrapper">
    <div class="row g-0 h-100" style="min-height: 100vh;">
        
        <div class="col-lg-7 d-none d-lg-block bg-image-side">
            <div class="bg-overlay">
                <h1 class="fw-bold display-4 mb-3">Si-Warga</h1>
                <h4 class="fw-light mb-4">Sistem Informasi Iuran & Kas Warga</h4>
                <p class="lead opacity-75">
                    "Permudah pengelolaan lingkungan kita. Transparan, Akuntabel, dan Terpercaya untuk kemajuan warga bersama."
                </p>
                <div class="mt-5">
                    <small class="text-white-50">&copy; {{ date('Y') }} Ananda Alfharizi Nst</small>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 form-side">
            <div class="login-card-custom">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Selamat Datang</h2>
                    <p class="text-muted">Silakan login untuk mengelola data</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="admin@warga.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-bold small text-uppercase text-muted">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted small" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login">
                            MASUK DASHBOARD
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Belum punya akun? 
                            <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar Warga</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection