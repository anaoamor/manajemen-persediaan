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
            $table->foreignId('id_kategori_perabot')->constrained();
            $table->text('deskripsi');
            $table->decimal('harga_minimal', 10, 2);
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
