<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangJadi extends Model
{
    protected $fillable = [
        'id_kategori_perabot',
        'deskripsi',
        'harga_minimal',
        'jumlah',
    ];
}
