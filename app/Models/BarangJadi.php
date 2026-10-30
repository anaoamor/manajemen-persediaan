<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangJadi extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'id_kategori_perabot',
        'id_pembuatan',
        'nama',
        'deskripsi',
        'harga_minimal',
        'jumlah',
    ];

    public function barangDijual(): HasMany
    {
        return $this->hasMany(BarangDijual::class, 'id_barang_jadi');
    }

    public function pembuatan(): BelongsTo
    {
        return $this->belongsTo(Pembuatan::class);
    }

    public function kategoriPerabot(): BelongsTo
    {
        return $this->belongsTo(KategoriPerabot::class, 'id_kategori_perabot');
    }
}
