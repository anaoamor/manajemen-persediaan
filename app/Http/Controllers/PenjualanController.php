<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\Pembeli;
use App\Models\Penjualan;
use DB;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
      $penjualans = Penjualan::with(['pembeli', 'barangDijual.barangJadi'])
      ->orderByDesc('id')
      ->paginate(15);
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
      $barangJadis = BarangJadi::whereHas('pembuatan', function($query){
        $query->where('status', '=', 'Selesai');
      })->orderByDesc('id')->get();
      $pembelis = Pembeli::orderByDesc('id')->get();
        return view('penjualan.create', compact('barangJadis', 'pembelis'));
    }

    public function store(Request $request)
    {
      $idBarangJadis = $request->input('id_barang_jadi.*');
      $jumlahBarangJadis = $request->input('jumlah_barang_jadi.*');
      DB::transaction(function() use ($idBarangJadis, $jumlahBarangJadis, $request){
        //Create penjualan
        $pembeli = Pembeli::findOrFail($request->input('id_pembeli'));
        $penjualan = $pembeli->penjualan()->create([
          'total_pembayaran' => $request->input('total_pembayaran'),
          'waktu' => now(),
        ]);

        //Update jumlah barang jadi dan create barangDijual
        foreach($idBarangJadis as $key => $idBarangJadi){
          $barangJadi = BarangJadi::findOrFail($idBarangJadi);
          $barangJadi->jumlah -= $jumlahBarangJadis[$key];
          $barangJadi->save();
          $penjualan->barangDijual()->create([
            'id_barang_jadi' => $idBarangJadi,
            'jumlah' => $jumlahBarangJadis[$key],
          ]);
        }
      });

      return redirect()->route('penjualan.index')->with('tambah success', 'Penjualan berhasil dibuat');
    }

    public function show(string $id)
    {
        // return view('penjualan.show', ['penjualan' => $penjualan]);
    }

    public function edit(Request $request, Penjualan $penjualan)
    {
        return view('penjualan.edit', ['penjualan' => $penjualan]);
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        
    }
    
    public function destroy(string $id){

    }

    public function search(Request $request){

    }
}
