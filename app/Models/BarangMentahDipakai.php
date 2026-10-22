<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangMentahDipakai extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'id_pembuatan',
        'id_barang_mentah',
        'deskripsi',
        'jumlah',
    ];

    public function barangMentah(): BelongsTo
    {
        return $this->belongsTo(BarangMentah::class);
    }

    public function pembuatan(): BelongsTo
    {
        return $this->belongsTo(Pembuatan::class);
    }
}
