<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'total_pembayaran',
        'waktu',
        'id_pembeli',
    ];
}
