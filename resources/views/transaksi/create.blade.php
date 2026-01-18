@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-cash-coin me-2"></i> Catat Pembayaran Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('transaksis.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Warga</label>
                            <select name="warga_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required>
                                <option value="" disabled selected>-- Pilih Nama Warga --</option>
                                @foreach($wargas as $w)
                                    <option value="{{ $w->id }}">{{ $w->nama_lengkap }} ({{ $w->blok_rumah }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Kategori Iuran</label>
                            <select name="kategori_iuran_id" class="form-select form-select-lg shadow-sm border-0 bg-light" required>
                                <option value="" disabled selected>-- Pilih Jenis Iuran --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }} - Rp {{ number_format($k->nominal, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Tanggal Pembayaran</label>
                            <input type="date" name="tanggal_bayar" class="form-control form-control-lg shadow-sm border-0 bg-light" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('transaksis.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection