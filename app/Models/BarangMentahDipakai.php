<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMentahDipakai extends Model
{
    protected $fillable = [
        'id_pembuatan',
        'id_barang_mentah',
        'deskripsi',
        'jumlah',
    ];
}
