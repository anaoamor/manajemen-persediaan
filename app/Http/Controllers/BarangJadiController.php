<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\Pembuatan;
use DB;
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
      $validatedData = $request->validate([
        'nama' => 'required|string',
        'deskripsi' => 'required|string',
        'jumlah' => 'required|numeric|min:0',
      ]);

      DB::transaction(function() use ($request, $id){

        $barangJadi = BarangJadi::findOrFail($id);
        $barangMentahDipakais = $barangJadi->pembuatan->barangMentahDipakai;
        $newHarga = 0;
        foreach($barangMentahDipakais as $barangMentahDipakai){
          $barangMentah = $barangMentahDipakai->barangMentah;
          $newHarga += ($barangMentahDipakai->jumlah * $barangMentah->harga_satuan);
        }
        $newHarga = $newHarga / $request->input('jumlah');
        $barangJadi->update([
          'nama' => $request->input('nama'),
          'deskripsi' => $request->input('deskripsi'),
          'harga_minimal' => $newHarga,
          'jumlah' => $request->input('jumlah')
        ]);
      });
      

      return redirect()->route('barang-jadi.index')->with('edit success', 'Barang jadi berhasil diperbarui');
    }

    public function search(Request $request){
      $searchTerm = $request->input('search');
      $barangJadis = BarangJadi::with('kategoriPerabot')
      ->whereHas('pembuatan', function($query){
        $query->where('status', '=', 'Selesai');
      })
      ->when($searchTerm, function($query, $searchTerm){
        $query->where('nama', 'LIKE', "%{$searchTerm}%");
      })->orderByDesc('id')
      ->paginate(15)
      ->withQueryString();

      return view('barang-jadi.search', compact('barangJadis', 'searchTerm'));
    }
}
