<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
   protected $fillable = ['nik', 'nama_lengkap', 'blok_rumah', 'no_hp'];

    // Relasi (Warga punya banyak transaksi)
    public function transaksis() {
        return $this->hasMany(Transaksi::class);
    }
}
