<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['warga_id', 'kategori_iuran_id', 'tanggal_bayar'];

    // 1. Relasi ke Warga
    public function warga() 
    {
        // Secara eksplisit menyebutkan 'warga_id' sebagai foreign key
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    // 2. Relasi ke Kategori
    public function kategori() 
    {
        // SANGAT PENTING: Tambahkan 'kategori_iuran_id' sebagai parameter kedua
        // Ini memberitahu Laravel kolom mana yang menjadi penyambung ke tabel kategori_iurans
        return $this->belongsTo(KategoriIuran::class, 'kategori_iuran_id');
    }
}