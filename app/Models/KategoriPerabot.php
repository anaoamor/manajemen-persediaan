<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPerabot extends Model
{
  public $timestamps = false;
    protected $fillable = [
        'nama',
    ];

    public function barangJadi():HasMany
    {
        return $this->hasMany(BarangJadi::class);
    }
}
