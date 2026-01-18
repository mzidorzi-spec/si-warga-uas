<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
        $table->foreignId('kategori_iuran_id')->constrained('kategori_iurans');
        $table->date('tanggal_bayar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
