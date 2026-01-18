<?php

namespace App\Http\Controllers;

use App\Models\KategoriIuran;
use Illuminate\Http\Request;

class KategoriIuranController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $kategoris = KategoriIuran::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        KategoriIuran::create($request->all());
        return redirect()->back()->with('success', 'Kategori iuran berhasil ditambahkan!');
    }

    public function update(Request $request, KategoriIuran $kategori) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $kategori->update($request->all());
        return redirect()->back()->with('success', 'Kategori iuran berhasil diperbarui!');
    }

    public function destroy(KategoriIuran $kategori) {
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori iuran berhasil dihapus!');
    }
}