<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMentah extends Model
{

  public $timestamps = false;

    protected $fillable = [
        'kode_item',
        'nama',
        'id_kategori',
        'satuan_hitung',
        'stok',
        'ukuran',
        'id_pemasoks',
        'waktu',
        'harga_satuan',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function pemasok(): BelongsTo
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasoks', 'id');
    }

    public function barangMentahDipakai(): HasMany
    {
        return $this->hasMany(BarangMentahDipakai::class, 'id_barang_mentah');
    }
}
