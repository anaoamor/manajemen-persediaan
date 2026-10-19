<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembeli extends Model
{
    protected $fillable = [
        'nama',
        'no_telepon',
        'alamat',
    ];

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class);
    }
}
