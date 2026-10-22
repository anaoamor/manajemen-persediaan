<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'total_pembayaran',
        'waktu',
        'id_pembeli',
    ];

    public function barangDijual():HasMany
    {
        return $this->hasMany(BarangDijual::class, 'id_penjualan');
    }

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(Pembeli::class);
    }
}
