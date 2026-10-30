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
        Schema::create('barang_jadis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori_perabot')->constrained('kategori_perabots');
            $table->foreignId('id_pembuatan')->constrained('pembuatans');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_minimal', 10, 2)->nullable();
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_jadis');
    }
};
