<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'nama',
    ];

    public function barangMentah(): HasMany
    {
        return $this->hasMany(BarangMentah::class);
    }
}
