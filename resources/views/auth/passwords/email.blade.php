@extends('layouts.app')

@section('content')
<style>
    nav.navbar { display: none !important; }
    main.py-4 { padding: 0 !important; }
    .reset-wrapper { min-height: 100vh; width: 100vw; overflow-x: hidden; }

    /* Sisi Kiri */
    .bg-image-side {
        background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1470&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .bg-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.9), rgba(0, 0, 0, 0.8)); /* Nuansa Kuning Gelap */
        display: flex; flex-direction: column; justify-content: center; padding: 4rem; color: white;
    }
    .form-side { background-color: #ffffff; display: flex; align-items: center; justify-content: center; padding: 2rem; }
    .reset-card-custom { width: 100%; max-width: 420px; }
    .form-control-lg { border-radius: 10px; font-size: 0.95rem; padding: 0.8rem 1rem; border: 1px solid #e1e1e1; background-color: #f8f9fa; }
    .form-control-lg:focus { background-color: #fff; box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.2); border-color: #ffc107; }
    .btn-reset { border-radius: 10px; padding: 0.8rem; font-weight: 600; letter-spacing: 0.5px; transition: all 0.3s; background-color: #ffc107; border: none; color: #000;}
    .btn-reset:hover { background-color: #e0a800; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3); }
</style>

<div class="container-fluid p-0 reset-wrapper">
    <div class="row g-0 h-100" style="min-height: 100vh;">
        
        <div class="col-lg-7 d-none d-lg-block bg-image-side">
            <div class="bg-overlay">
                <h1 class="fw-bold display-4 mb-3">Lupa Password?</h1>
                <h4 class="fw-light mb-4">Tenang, Kami Bantu Pulihkan.</h4>
                <p class="lead opacity-75">
                    "Keamanan akun adalah prioritas. Masukkan email anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi anda."
                </p>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 form-side">
            <div class="reset-card-custom">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Reset Password</h2>
                    <p class="text-muted">Masukkan email yang terdaftar</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-reset btn-lg">
                            KIRIM LINK RESET
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-none">
                            &larr; Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection