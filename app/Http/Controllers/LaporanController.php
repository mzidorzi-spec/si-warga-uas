<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        // 1. Tentukan Bulan & Tahun (Default: Bulan Ini)
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // 2. Query Pemasukan (Filter Waktu)
        $transaksis = Transaksi::with('kategori')
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->latest()
            ->get();
            
        $totalMasuk = $transaksis->sum(function($t) {
            return $t->kategori->nominal ?? 0;
        });

        // 3. Query Pengeluaran (Filter Waktu)
        $pengeluarans = Pengeluaran::whereMonth('tanggal_keluar', $bulan)
            ->whereYear('tanggal_keluar', $tahun)
            ->latest()
            ->get();

        $totalKeluar = $pengeluarans->sum('nominal');

        // 4. Saldo Bersih (Bulan Terpilih)
        $saldoAkhir = $totalMasuk - $totalKeluar;

        return view('laporan.index', compact(
            'transaksis', 'pengeluarans', 
            'totalMasuk', 'totalKeluar', 'saldoAkhir',
            'bulan', 'tahun'
        ));
    }
}