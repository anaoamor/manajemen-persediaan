<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangDijual extends Model
{
    protected $fillable = [
        'id_penjualan',
        'id_barang_jadi',
        'jumlah',
    ];

    public function penjualan():BelongsTo
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function barangJadi():BelongsTo
    {
        return $this->belongsTo(BarangJadi::class);
    }
}
