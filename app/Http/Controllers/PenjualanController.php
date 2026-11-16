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
      })
      ->where('jumlah', '>', 0)
      ->orderByDesc('id')->get();
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
        return view('penjualan.show', ['penjualan' => Penjualan::with(['pembeli', 'barangDijual.barangJadi'])->findOrFail($id)]);
    }

    public function edit(string $id)
    {
      $penjualan = Penjualan::with(['pembeli', 'barangDijual.barangJadi'])->findOrFail($id);
      $pembelis = Pembeli::orderByDesc('id')->get();
      $barangJadis = BarangJadi::whereHas('pembuatan', function($query){
        $query->where('status', '=', 'Selesai');
      })
      ->where('jumlah', '>', 0)
      ->orderByDesc('id')->get();
        return view('penjualan.edit', compact('penjualan', 'pembelis', 'barangJadis'));
    }

    public function update(Request $request, string $id)
    {
        $newBarangJadis = $request->input('id_barang_jadi.*');
        $newJumlahBarangJadis = $request->input('jumlah_barang_jadi.*');
        
        DB::transaction(function() use ($newBarangJadis, $newJumlahBarangJadis, $id, $request){
          $penjualan = Penjualan::findOrFail($id);
          $oldBarangJadis = $penjualan->barangDijual;
          foreach($oldBarangJadis as $oldBarangJadi){
            $position = array_search($oldBarangJadi->id_barang_jadi, $newBarangJadis);
            if($position === false){
              $barangJadi = $oldBarangJadi->barangJadi;
              $barangJadi->jumlah += $oldBarangJadi->jumlah;
              $barangJadi->save();
              $oldBarangJadi->where('id_penjualan', $oldBarangJadi->id_penjualan)
              ->where('id_barang_jadi', $oldBarangJadi->id_barang_jadi)
              ->delete();
            }else{
              $barangJadi = $oldBarangJadi->barangJadi;
              $barangJadi->jumlah -= ($newJumlahBarangJadis[$position] - $oldBarangJadi->jumlah);
              $barangJadi->save();

              $oldBarangJadi->where('id_penjualan', $oldBarangJadi->id_penjualan)
              ->where('id_barang_jadi', $oldBarangJadi->id_barang_jadi)
              ->update(['jumlah' => $newJumlahBarangJadis[$position]]);

              array_splice($newBarangJadis, $position, 1);
              array_splice($newJumlahBarangJadis, $position, 1);
            }
          }

          foreach($newBarangJadis as $key => $newBarangJadi){
            $barangJadi = BarangJadi::findOrFail($newBarangJadi);
            $barangJadi->jumlah -= $newJumlahBarangJadis[$key];
            $barangJadi->save();

            $penjualan->barangDijual()->create([
              'id_barang_jadi' => $newBarangJadi,
              'jumlah' => $newJumlahBarangJadis[$key],
            ]);
          }

          $penjualan->update([
            'total_pembayaran' => $request->input('total_pembayaran'),
            'id_pembeli' => $request->input('id_pembeli'),
          ]);
        });

        return redirect()->route('penjualan.index')->with('edit success', 'Penjualan berhasil diperbarui');
    }
    
    public function destroy(string $id){
      DB::transaction(function() use($id){
        $penjualan = Penjualan::findOrFail($id);
        $barangDijuals = $penjualan->barangDijual;
        foreach($barangDijuals as $barangDijual){
          $barangJadi = $barangDijual->barangJadi;
          $barangJadi->update(['jumlah' => $barangJadi->jumlah + $barangDijual->jumlah]);
        }
        $penjualan->barangDijual()->delete();
        $penjualan->delete();
      });

      return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus');
    }

    public function search(Request $request){
      $searchTerm = $request->input('search');
      $penjualans = Penjualan::with(['pembeli', 'barangDijual.barangJadi'])
      ->when($searchTerm, function($query, $searchTerm){
          $query->whereHas('barangDijual.barangJadi', function($q) use ($searchTerm){
            $q->where('nama', 'LIKE', "%{$searchTerm}");
          });
      })->orderByDesc('id')
      ->paginate(15)
      ->withQueryString();

      return view('penjualan.search', compact('penjualans', 'searchTerm'));
    }
}
