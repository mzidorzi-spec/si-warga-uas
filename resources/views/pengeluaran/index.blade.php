@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-0">Pengeluaran Kas</h3>
            <p class="text-muted mb-0">Catat setiap penggunaan dana kas warga.</p>
        </div>
        <button class="btn btn-danger px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i>Tambah Pengeluaran
        </button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 border-0">Tanggal</th>
                            <th class="py-3 border-0">Keperluan</th>
                            <th class="py-3 border-0">Nominal</th>
                            <th class="py-3 border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengeluarans as $p)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_keluar)->format('d/m/Y') }}</td>
                            <td class="fw-bold">{{ $p->judul_pengeluaran }}</td>
                            <td class="text-danger fw-bold">- Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('pengeluarans.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada catatan pengeluaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pengeluarans.store') }}" method="POST">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">Catat Pengeluaran Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul/Keperluan</label>
                        <input type="text" name="judul_pengeluaran" class="form-control" placeholder="Contoh: Perbaikan Lampu Jalan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal (Rp)</label>
                        <input type="number" name="nominal" class="form-control" placeholder="Contoh: 150000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection