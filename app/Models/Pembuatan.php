<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembuatan extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'jumlah',
        'waktu',
        'status',
    ];

    public function barangJadi():HasOne
    {
        return $this->hasOne(BarangJadi::class, 'id_pembuatan');
    }

    public function barangMentahDipakai(): HasMany
    {
        return $this->hasMany(BarangMentahDipakai::class, 'id_pembuatan');
    }
}
