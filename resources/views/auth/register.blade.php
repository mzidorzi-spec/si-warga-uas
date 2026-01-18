@extends('layouts.app')

@section('content')
<style>
    nav.navbar { display: none !important; }
    main.py-4 { padding: 0 !important; }
    .register-wrapper { min-height: 100vh; width: 100vw; overflow-x: hidden; }

    /* Sisi Kiri (Gambar Berbeda untuk Register) */
    .bg-image-side {
        background-image: url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1470&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .bg-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.9), rgba(0, 0, 0, 0.7)); /* Nuansa Hijau untuk Register */
        display: flex; flex-direction: column; justify-content: center; padding: 4rem; color: white;
    }
    .form-side { background-color: #ffffff; display: flex; align-items: center; justify-content: center; padding: 2rem; }
    .register-card-custom { width: 100%; max-width: 500px; } /* Sedikit lebih lebar */
    .form-control-lg { border-radius: 10px; font-size: 0.95rem; padding: 0.8rem 1rem; border: 1px solid #e1e1e1; background-color: #f8f9fa; }
    .form-control-lg:focus { background-color: #fff; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15); border-color: #198754; }
    .btn-register { border-radius: 10px; padding: 0.8rem; font-weight: 600; letter-spacing: 0.5px; transition: all 0.3s; background-color: #198754; border: none; color: white;}
    .btn-register:hover { background-color: #157347; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3); }
</style>

<div class="container-fluid p-0 register-wrapper">
    <div class="row g-0 h-100" style="min-height: 100vh;">
        
        <div class="col-lg-6 d-none d-lg-block bg-image-side">
            <div class="bg-overlay">
                <h1 class="fw-bold display-4 mb-3">Gabung Warga</h1>
                <h4 class="fw-light mb-4">Mari Berkontribusi untuk Lingkungan</h4>
                <p class="lead opacity-75">
                    "Daftarkan diri anda untuk kemudahan akses informasi iuran, kas, dan kegiatan warga. Satu akun untuk transparansi bersama."
                </p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 form-side">
            <div class="register-card-custom">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark">Buat Akun Baru</h2>
                    <p class="text-muted">Isi data diri anda dengan benar</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Contoh: Budi Santoso">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">Alamat Email</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="budi@warga.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Password</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Ulangi Password</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang password">
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-register btn-lg">
                            DAFTAR SEKARANG
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="small text-muted">Sudah punya akun? 
                            <a href="{{ route('login') }}" class="fw-bold text-success text-decoration-none">Login Disini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection