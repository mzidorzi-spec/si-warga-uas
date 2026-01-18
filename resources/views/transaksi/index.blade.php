@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-0">Transaksi Iuran</h3>
            <p class="text-muted mb-0">Riwayat pembayaran iuran warga.</p>
        </div>
        <a href="{{ route('transaksis.create') }}" class="btn btn-primary px-4 rounded-pill">
            <i class="bi bi-plus-lg me-2"></i>Catat Pembayaran
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 border-0">Tanggal</th>
                            <th class="py-3 border-0">Nama Warga</th>
                            <th class="py-3 border-0">Kategori</th>
                            <th class="py-3 border-0">Nominal</th>
                            <th class="py-3 border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal_bayar)->format('d M Y') }}</td>
                            <td class="fw-bold text-dark">{{ $t->warga->nama_lengkap }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $t->kategori->nama_kategori }}</span></td>
                            <td class="fw-bold text-success">Rp {{ number_format($t->kategori->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('transaksis.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection