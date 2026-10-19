<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_mentah_dipakai', function (Blueprint $table) {
            $table->foreignId('id_pembuatan')->constrained();
            $table->foreignId('id_barang_mentah')->constrained();
            $table->text('deskripsi');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_mentah_dipakai');
    }
};
