<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemasok extends Model
{
  protected $table = 'pemasoks';
  public $timestamps = false;
    protected $fillable = [
        'nama',
        'no_telepon',
        'alamat',
    ];

    public function barangMentah(): HasMany
    {
        return $this->hasMany(BarangMentah::class, 'id_pemasoks');
    }
}
