<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\Pembuatan;
use Illuminate\Http\Request;

class BarangJadiController extends Controller
{
    
    public function index()
    {
      $barangJadis = BarangJadi::with('kategoriPerabot')
      ->whereHas('pembuatan', function($query){
        $query->where('status', 'Selesai');
      })
      ->orderByDesc('id')
      ->paginate(15);
      
      return view('barang-jadi.index', ['barangJadis' => $barangJadis]);
    }

    public function show($id)
    {
      $barangJadi = BarangJadi::with('kategoriPerabot')
      ->findOrFail($id);
      
      return view('barang-jadi.show', ['barangJadi' => $barangJadi]);
    }

    public function edit(string $id){
      $barangJadi = BarangJadi::with('kategoriPerabot')
      ->findOrFail($id);

      return view('barang-jadi.edit', compact('barangJadi'));
    }

    public function update(Request $request, $id){

    }

    public function search(Request $request){

    }
}
