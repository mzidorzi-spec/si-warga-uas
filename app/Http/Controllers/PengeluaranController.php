<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $pengeluarans = Pengeluaran::latest()->get();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul_pengeluaran' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal_keluar' => 'required|date',
        ]);

        Pengeluaran::create($request->all());
        return redirect()->back()->with('success', 'Catatan pengeluaran berhasil disimpan!');
    }

    public function destroy(Pengeluaran $pengeluaran) {
        $pengeluaran->delete();
        return redirect()->back()->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}