<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMentah extends Model
{
    protected $fillable = [
        'kode_item',
        'nama',
        'id_kategori',
        'satuan_hitung',
        'stok',
        'ukuran',
        'id_pemasok',
        'waktu',
        'harga_satuan',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pemasok(): BelongsTo
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function barangMentahDipakai(): HasMany
    {
        return $this->hasMany(BarangMentahDipakai::class, 'id_barang_mentah');
    }
}
