@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-0">Dashboard</h2>
            <p class="text-muted mb-0">Ringkasan aktivitas sistem Si-Warga</p>
        </div>
        <a href="{{ route('transaksis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
        </a>
    </div>

    <div class="row g-4 mb-5">
    <div class="col-md-4">
        @php
            $isKritis = ($totalPemasukan > 0) && ($totalPengeluaran > ($totalPemasukan * 0.8));
        @endphp
        <div class="card border-0 shadow-sm text-white" 
            style="background: {{ $isKritis ? 'linear-gradient(135deg, #dc3545 0%, #a71d2a 100%)' : 'linear-gradient(135deg, #198754 0%, #0d5a35 100%)' }};">
            <div class="card-body p-4">
                <small class="opacity-75 text-uppercase fw-bold">
                    Saldo Kas Warga {{ $isKritis ? '(KRITIS!)' : '(SEHAT)' }}
                </small>
                <h2 class="fw-bold mb-0">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h2>
                @if($isKritis)
                    <p class="small mb-0 mt-2 text-white-50">* Pengeluaran sudah mencapai 80% dari total pemasukan.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-white">
            <div class="card-body p-4 border-start border-primary border-5 rounded">
                <small class="text-muted text-uppercase fw-bold">Total Iuran Masuk</small>
                <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-white">
            <div class="card-body p-4 border-start border-danger border-5 rounded">
                <small class="text-muted text-uppercase fw-bold">Total Pengeluaran</small>
                <h3 class="fw-bold text-danger mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Tren Pemasukan {{ date('Y') }}</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="pemasukanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="fw-bold mb-0">Informasi Sistem</h5>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                        <span><i class="bi bi-server me-2 text-muted"></i> Status Server</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                        <span><i class="bi bi-database me-2 text-muted"></i> Database</span>
                        <span class="badge bg-primary">Connected</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                        <span><i class="bi bi-code-slash me-2 text-muted"></i> Laravel Version</span>
                        <span class="text-muted fw-bold">12.x</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('pemasukanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Pemasukan (Rp)',
                    data: @json($chartData),
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection