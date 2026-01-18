<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
{
    // 1. Hitung Total Iuran Masuk (Pemasukan)
    $totalPemasukan = \App\Models\Transaksi::join('kategori_iurans', 'transaksis.kategori_iuran_id', '=', 'kategori_iurans.id')
        ->sum('nominal');

    // 2. Hitung Total Pengeluaran (Gunakan 0 jika tabel belum ada atau kosong)
    // Pastikan Anda sudah membuat model Pengeluaran
    $totalPengeluaran = \Schema::hasTable('pengeluarans') 
        ? \App\Models\Pengeluaran::sum('nominal') 
        : 0;

    // 3. Hitung Saldo Kas Bersih
    // Rumus: $saldoKas = totalPemasukan - totalPengeluaran$
    $saldoKas = $totalPemasukan - $totalPengeluaran;

    // 4. Siapkan Data Chart (Pemasukan per bulan)
    $dataPemasukan = \App\Models\Transaksi::join('kategori_iurans', 'transaksis.kategori_iuran_id', '=', 'kategori_iurans.id')
        ->selectRaw('MONTH(tanggal_bayar) as bulan, SUM(nominal) as total')
        ->whereYear('tanggal_bayar', date('Y'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->all();

    $chartData = [];
    for ($i = 1; $i <= 12; $i++) {
        $chartData[] = $dataPemasukan[$i] ?? 0;
    }

    // Kirim semua variabel ke view home
    return view('home', compact(
        'totalPemasukan', 
        'totalPengeluaran', 
        'saldoKas', 
        'chartData'
    ));
    
}
}
