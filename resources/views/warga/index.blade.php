@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-0">Data Warga</h3>
            <p class="text-muted mb-0">Kelola data penduduk lingkungan anda.</p>
        </div>
        <div>
            <a href="{{ route('wargas.create') }}" class="btn btn-primary px-4 rounded-pill">
                <i class="bi bi-plus-lg me-2"></i>Tambah Warga
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            
            <div class="row mb-4">
                <div class="col-md-5">
                    <form action="{{ route('wargas.index') }}" method="GET">
                        <div class="input-group">
                            <button class="btn btn-outline-secondary border-end-0 border bg-white" type="submit">
                                <i class="bi bi-search text-muted"></i>
                            </button>
                            
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Cari Nama, NIK, atau Blok..." 
                                   value="{{ request('search') }}"> 
                                   </div>
                    </form>
                </div>

                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('wargas.index') }}" class="btn btn-light border text-muted">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </a>
                </div>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 text-muted text-uppercase small fw-bold border-0">Profil Warga</th>
                            <th class="py-3 text-muted text-uppercase small fw-bold border-0">NIK</th>
                            <th class="py-3 text-muted text-uppercase small fw-bold border-0">Blok Rumah</th>
                            <th class="py-3 text-muted text-uppercase small fw-bold border-0">Kontak</th>
                            <th class="py-3 text-muted text-uppercase small fw-bold border-0 text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wargas as $w)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ substr($w->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $w->nama_lengkap }}</div>
                                        <small class="text-muted">Terdaftar: {{ $w->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-medium text-secondary">{{ $w->nik }}</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2 rounded-pill">
                                    <i class="bi bi-house-door me-1"></i> {{ $w->blok_rumah }}
                                </span>
                            </td>
                            <td>
                                <a href="https://wa.me/{{ $w->no_hp }}" target="_blank" class="text-decoration-none text-success fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> {{ $w->no_hp }}
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('wargas.edit', $w->id) }}" class="btn btn-sm btn-outline-warning border-0" title="Edit Data">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>
                                    <form action="{{ route('wargas.destroy', $w->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data {{ $w->nama_lengkap }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Hapus Data">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    <p class="mb-0">Belum ada data warga.</p>
                                    <a href="{{ route('wargas.create') }}" class="btn btn-link text-decoration-none">Tambah data baru</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{-- {{ $wargas->links() }} --}}
            </div>

        </div>
    </div>
</div>
@endsection