<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembuatan extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'id_barang_jadi',
        'waktu',
        'jumlah',
        'status',
    ];

    public function barangJadi():HasOne
    {
        return $this->hasOne(BarangJadi::class);
    }

    public function barangMentahDipakai(): HasMany
    {
        return $this->hasMany(BarangMentahDipakai::class, 'id_pembuatan');
    }
}
