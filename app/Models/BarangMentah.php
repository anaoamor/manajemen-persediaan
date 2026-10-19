<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMentah extends Model
{
    protected $fillable = [
        'kode_item',
        'nama',
        'id_kategori',
        'satuan_hitung',
        'stok',
        'ukuran',
        'id_pemasok',
        'waktu',
        'harga_satuan',
    ];
}
