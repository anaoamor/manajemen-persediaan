<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembuatan extends Model
{
    protected $fillable = [
        'id_barang_jadi',
        'waktu',
        'jumlah',
        'status',
    ];
}
