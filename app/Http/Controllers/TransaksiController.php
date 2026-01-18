<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Warga;
use App\Models\KategoriIuran;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // Eager loading untuk mengambil data warga dan kategori sekaligus
        $transaksis = Transaksi::with(['warga', 'kategori'])->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create() {
        $wargas = Warga::all();
        $kategoris = KategoriIuran::all();
        return view('transaksi.create', compact('wargas', 'kategoris'));
    }

    public function store(Request $request) {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'kategori_iuran_id' => 'required|exists:kategori_iurans,id',
            'tanggal_bayar' => 'required|date',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('transaksis.index')->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function destroy(Transaksi $transaksi) {
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Data transaksi berhasil dihapus!');
    }
}