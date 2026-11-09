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

    protected function setKeysForSaveQuery($query){
      $query->where('id_pembuatan', '=', $this->getAttribute('id_pembuata'))
      ->where('id_barang_mentah', '=', $this->get('id_barang_mentah'));

      return $query;
    }

    public function barangMentah(): BelongsTo
    {
        return $this->belongsTo(BarangMentah::class, 'id_barang_mentah');
    }

    public function pembuatan(): BelongsTo
    {
        return $this->belongsTo(Pembuatan::class, 'id_pembuatan');
    }
}
