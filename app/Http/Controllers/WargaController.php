<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // Supaya harus login dulu baru bisa akses
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // 1. Mulai Query Warga
        $query = Warga::query();

        // 2. Cek apakah ada kiriman 'search' dari form
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Filter berdasarkan Nama ATAU NIK ATAU Blok
            $query->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%")
                  ->orWhere('blok_rumah', 'LIKE', "%{$search}%");
        }

        // 3. Ambil datanya (bisa diganti ->paginate(10) kalau datanya banyak)
        $wargas = $query->get();

        // 4. Kirim ke View
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|unique:wargas',
            'nama_lengkap' => 'required',
            'blok_rumah' => 'required',
            'no_hp' => 'required',
        ]);

        Warga::create($request->all());
        return redirect()->route('wargas.index')->with('success', 'Warga berhasil ditambahkan!');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik' => 'required|numeric',
            'nama_lengkap' => 'required',
        ]);

        $warga->update($request->all());
        return redirect()->route('wargas.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('wargas.index')->with('success', 'Data berhasil dihapus!');
    }
}