<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
      return view('kategori.index', ['kategoris' => Kategori::orderByDesc('id')->paginate(15)]);
    }

    public function create()
    {
      return view('kategori.create');
    }

    public function store(Request $request){
      $validatedData = $request->validate([
        'nama' => 'required|string',
      ]);

      $kategori = Kategori::create([
        'nama' => $validatedData['nama'],
      ]);

      return redirect()->route('kategori.index')->with('tambah success', 'Kategori berhasil ditambahkan');
    }
}
