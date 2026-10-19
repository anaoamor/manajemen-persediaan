<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $fillable = [
        'nama',
        'no_telepon',
        'alamat',
    ];
}
