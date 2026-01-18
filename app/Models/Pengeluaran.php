<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengeluaran extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk menentukan kolom yang boleh diisi
    protected $fillable = [
        'judul_pengeluaran', 
        'nominal', 
        'tanggal_keluar'
    ];
}