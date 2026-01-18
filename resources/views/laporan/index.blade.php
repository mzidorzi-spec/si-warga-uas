@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="card border-0 shadow-sm mb-4 no-print">
        <div class="card-body p-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan Keuangan</h4>
                <p class="text-muted small mb-0">Periode: {{ \Carbon\Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F') }} {{ $tahun }}</p>
            </div>
            
            <div class="d-flex gap-2">
                <form action="{{ route('laporan.index') }}" method="GET" class="d-flex gap-2">
                    <select name="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate(null, $m, 1)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                    <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                        @for($y = date('Y'); $y >= date('Y')-2; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </form>

                <button class="btn btn-dark btn-sm px-3" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i>Cetak
                </button>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
                    <div>
                        <small class="text-uppercase fw-bold text-muted">Pemasukan</small>
                        <h3 class="fw-bold text-primary mb-0 mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-arrow-down-left text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-uppercase fw-bold text-muted">Pengeluaran</small>
                        <h3 class="fw-bold text-danger mb-0 mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-arrow-up-right text-danger fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100 bg-success text-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-uppercase fw-bold text-white-50">Saldo Periode Ini</small>
                        <h3 class="fw-bold mb-0 mt-1">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle text-white">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom border-light pt-3 px-4">
            <ul class="nav nav-tabs card-header-tabs" id="laporanTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active fw-bold" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" type="button">
                        <i class="bi bi-arrow-down-circle text-primary me-2"></i>Rincian Pemasukan
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" type="button">
                        <i class="bi bi-arrow-up-circle text-danger me-2"></i>Rincian Pengeluaran
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body p-0">
            <div class="tab-content" id="laporanTabContent">
                
                <div class="tab-pane fade show active" id="masuk" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3">Tanggal</th>
                                    <th class="py-3">Nama Warga</th>
                                    <th class="py-3">Kategori</th>
                                    <th class="pe-4 py-3 text-end">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksis as $t)
                                <tr>
                                    <td class="ps-4 text-muted">{{ \Carbon\Carbon::parse($t->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                                    <td class="fw-bold">{{ $t->warga->nama_lengkap ?? 'Data Terhapus' }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $t->kategori->nama_kategori ?? '-' }}</span></td>
                                    <td class="pe-4 text-end fw-bold text-success">+ {{ number_format($t->kategori->nominal ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-5 text-muted">Tidak ada data pemasukan bulan ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="keluar" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3">Tanggal</th>
                                    <th class="py-3">Keperluan / Keterangan</th>
                                    <th class="pe-4 py-3 text-end">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengeluarans as $p)
                                <tr>
                                    <td class="ps-4 text-muted">{{ \Carbon\Carbon::parse($p->tanggal_keluar)->translatedFormat('d F Y') }}</td>
                                    <td class="fw-bold">{{ $p->judul_pengeluaran }}</td>
                                    <td class="pe-4 text-end fw-bold text-danger">- {{ number_format($p->nominal, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-5 text-muted">Tidak ada data pengeluaran bulan ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="d-none d-print-block mt-5">
        <div class="row">
            <div class="col-4 offset-8 text-center">
                <p>Diketahui Oleh,<br>Ketua RT / Pengurus</p>
                <br><br><br>
                <p class="fw-bold text-decoration-underline">( ........................................ )</p>
            </div>
        </div>
    </div>

</div>

<style>
    /* Custom Styling untuk Tabs agar lebih modern */
    .nav-tabs .nav-link { border: none; color: #6c757d; padding: 1rem 1.5rem; transition: all 0.2s; }
    .nav-tabs .nav-link:hover { color: #0d6efd; background: #f8f9fa; border-radius: 8px; }
    .nav-tabs .nav-link.active { color: #0d6efd; background: transparent; border-bottom: 3px solid #0d6efd; border-radius: 0; }
    
    /* Styling Cetak (Print) */
    @media print {
        .no-print, #sidebar-wrapper, .navbar { display: none !important; }
        #page-content-wrapper { margin: 0 !important; padding: 0 !important; width: 100% !important; }
        .card { border: 1px solid #ddd !important; shadow: none !important; margin-bottom: 20px !important; }
        
        /* Saat print, kita paksa kedua tab konten muncul berurutan */
        .tab-content > .tab-pane { display: block !important; opacity: 1 !important; margin-bottom: 2rem; }
        .nav-tabs { display: none !important; } /* Sembunyikan tombol tab saat print */
        
        /* Judul Tabel Manual untuk Print */
        #masuk::before { content: "RINCIAN PEMASUKAN"; display: block; font-weight: bold; margin-bottom: 10px; text-decoration: underline; }
        #keluar::before { content: "RINCIAN PENGELUARAN"; display: block; font-weight: bold; margin-bottom: 10px; text-decoration: underline; border-top: 1px dashed #ccc; padding-top: 20px; }
    }
</style>
@endsection