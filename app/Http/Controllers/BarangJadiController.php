<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangJadiController extends Controller
{
    
    public function index()
    {
        return view('barang-jadi.index');
    }

    public function show($id)
    {
        return view('barang-jadi.show', ['id' => $id]);
    }
}
