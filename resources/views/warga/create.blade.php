@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <a href="{{ route('wargas.index') }}" class="text-decoration-none text-muted mb-3 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-3 px-4 border-0">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus-fill me-2"></i> Tambah Warga Baru</h5>
                </div>
                
                <div class="card-body p-5">
                    <form action="{{ route('wargas.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-12 mb-1">
                                <h6 class="text-uppercase text-muted fw-bold small border-bottom pb-2">Identitas Personal</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor Induk Kependudukan (NIK)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-card-heading text-muted"></i></span>
                                    <input type="number" name="nik" class="form-control border-start-0 bg-light @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="16 digit angka" required>
                                </div>
                                @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="nama_lengkap" class="form-control border-start-0 bg-light @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" placeholder="Sesuai KTP" required>
                                </div>
                                @error('nama_lengkap') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-12 mt-4 mb-1">
                                <h6 class="text-uppercase text-muted fw-bold small border-bottom pb-2">Domisili & Kontak</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Blok / Nomor Rumah</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-house-door text-muted"></i></span>
                                    <input type="text" name="blok_rumah" class="form-control border-start-0 bg-light @error('blok_rumah') is-invalid @enderror" value="{{ old('blok_rumah') }}" placeholder="Contoh: A5/12" required>
                                </div>
                                @error('blok_rumah') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor WhatsApp / HP</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-whatsapp text-muted"></i></span>
                                    <input type="text" name="no_hp" class="form-control border-start-0 bg-light @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                                </div>
                                @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                            <a href="{{ route('wargas.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                <i class="bi bi-save me-2"></i>Simpan Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection