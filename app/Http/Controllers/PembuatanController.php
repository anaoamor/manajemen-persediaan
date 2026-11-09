<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\BarangMentah;
use App\Models\BarangMentahDipakai;
use App\Models\KategoriPerabot;
use App\Models\Pembuatan;
use DB;
use Illuminate\Http\Request;

class PembuatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $pembuatans = Pembuatan::with('barangJadi')->orderByDesc('id')->paginate(15);        
      return view('buat.index', compact('pembuatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buat.create', [
          'kategoris' => KategoriPerabot::orderByDesc('id')->get(),
          'barangMentahs' => BarangMentah::orderByDesc('id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idBarangMentahs = $request->input('id_barang_mentah.*');
        $jumlahBarangMentahs = $request->input('jumlah_barang_mentah.*');
       
        DB::transaction(function() use ($idBarangMentahs, $jumlahBarangMentahs, $request){
          $pembuatan = Pembuatan::create([
            'waktu' => now(),
            'status' => 'Proses',
          ]);
          
          //Calculate minimal price to sell the final product
          $totalHargaBahanMentah = 0;
          foreach($idBarangMentahs as $key => $value){
            $bahanMentah = BarangMentah::findOrFail($value);
            $totalHargaBahanMentah += ($bahanMentah->harga_satuan * $jumlahBarangMentahs[$key]);
            
            //Update stok barang mentah
            $bahanMentah->stok -= $jumlahBarangMentahs[$key];
            $bahanMentah->save();

            //Create record for barang mentah dipakai
            $pembuatan->barangMentahDipakai()->create([
              'id_barang_mentah' => $value,
              'jumlah' => $jumlahBarangMentahs[$key],
            ]);
          }
          $hargaBarangJadiMinimal = ($totalHargaBahanMentah/$request->input('jumlah'));

          $pembuatan->barangJadi()->create([
            'id_kategori_perabot' => $request->input('id_kategori'),
            'nama' => $request->input('nama_barang_jadi'),
            'harga_minimal' => $hargaBarangJadiMinimal,
            'jumlah' => $request->input('jumlah'),
          ]);

          
        });

        return redirect()->route('pembuatan.index')->with('tambah success', 'Pembuatan barang jadi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembuatan = Pembuatan::findOrFail($id);
        $barangJadi = $pembuatan->barangJadi;
        $kategori = $barangJadi->kategoriPerabot;
        $barangMentahDipakais = $pembuatan->barangMentahDipakai;
        $namaBarangMentahs = [];
        foreach($barangMentahDipakais as $barangMentahDipakai){
          $namaBarangMentahs[] = $barangMentahDipakai->barangMentah->nama;
        }
        
        return view('buat.show', compact('pembuatan', 'barangJadi', 'kategori', 'barangMentahDipakais', 'namaBarangMentahs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoris = KategoriPerabot::orderByDesc('id')->get();
        $barangMentahs = BarangMentah::orderByDesc('id')->get();

        $pembuatan = Pembuatan::findOrFail($id);
        $barangJadi = $pembuatan->barangJadi;
        $kategoriTerpilih = $barangJadi->kategoriPerabot;
        $barangMentahDipakais = $pembuatan->barangMentahDipakai;

        return view('buat.edit', compact('kategoris', 'barangMentahs', 'pembuatan', 'barangJadi', 'kategoriTerpilih', 'barangMentahDipakais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $newIdBarangMentahDipakais = $request->input('id_barang_mentah.*');
      $newJumlahBarangMentahDipakais = $request->input('jumlah_barang_mentah.*');
      
      DB::transaction(function() use ($newIdBarangMentahDipakais, $newJumlahBarangMentahDipakais, $id, $request){
      
        $pembuatan = Pembuatan::findOrFail($id);
        $oldBarangMentahDipakais = BarangMentahDipakai::where('id_pembuatan', $id)->get();
        
        $totalHargaBahanMentah = 0;

        foreach($oldBarangMentahDipakais as $oldBarangMentahDipakai){
          $foundIndex = array_search($oldBarangMentahDipakai->id_barang_mentah, $newIdBarangMentahDipakais);
          if($foundIndex === false){
            $barangMentah = $oldBarangMentahDipakai->barangMentah;
            $barangMentah->stok = ($barangMentah->stok + $oldBarangMentahDipakai->jumlah);
            $barangMentah->save();
            $oldBarangMentahDipakai->where('id_pembuatan', $oldBarangMentahDipakai->id_pembuatan)
            ->where('id_barang_mentah', $oldBarangMentahDipakai->id_barang_mentah)
            ->delete();
          }else{
            //Update barang mentah stok
            $barangMentah = $oldBarangMentahDipakai->barangMentah;
            $barangMentah->update(['stok' => $barangMentah->stok - ($newJumlahBarangMentahDipakais[$foundIndex] - $oldBarangMentahDipakai->jumlah)]);

            $oldBarangMentahDipakai->where('id_pembuatan', $id)->where('id_barang_mentah', $oldBarangMentahDipakai->id_barang_mentah)->update(['jumlah' => $newJumlahBarangMentahDipakais[$foundIndex]]);

            $totalHargaBahanMentah += ($barangMentah->harga_satuan * $newJumlahBarangMentahDipakais[$foundIndex]);
            array_splice($newIdBarangMentahDipakais, $foundIndex, 1);
            array_splice($newJumlahBarangMentahDipakais, $foundIndex, 1);
          }

        }

        //new barang mentah dipakai records
        foreach($newIdBarangMentahDipakais as $key => $newIdBarangMentahDipakai){
          $barangMentah = BarangMentah::findOrFail($newIdBarangMentahDipakai);
          $barangMentah->update(['stok' => ($barangMentah->stok - $newJumlahBarangMentahDipakais[$key])]);

          $totalHargaBahanMentah += ($barangMentah->harga_satuan * $newJumlahBarangMentahDipakais[$key]);

          $pembuatan->barangMentahDipakai()->create([
            'id_barang_mentah' => $newIdBarangMentahDipakai,
            'jumlah' => $newJumlahBarangMentahDipakais[$key],
          ]);
        }

        $totalHargaBahanMentah = ($totalHargaBahanMentah / $request->input('jumlah'));

        $pembuatan->barangJadi()->update([
          'nama' => $request->input('nama_barang_jadi'),
          'id_kategori_perabot' => $request->input('id_kategori'),
          'harga_minimal' => $totalHargaBahanMentah,
          'jumlah' => $request->input('jumlah'),
        ]);
      });

      return redirect()->route('pembuatan.index')->with('edit success', 'Pembuatan berhasil diperbarui');
    }

    public function selesai(string $id){
      $pembuatan = Pembuatan::findOrFail($id)->update(['status' => 'Selesai']);
      return redirect()->route('pembuatan.index')->with('selesai success', 'Pembuatan selesai');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      DB::transaction(function() use ($id){
        $pembuatan = Pembuatan::findOrFail($id);
        $barangJadi = $pembuatan->barangJadi();
        $barangJadi->delete();

        $barangMentahDipakais = $pembuatan->barangMentahDipakai;
        foreach($barangMentahDipakais as $barangMentahDipakai){
          // dump($barangMentahDipakai);
          $barangMentah = $barangMentahDipakai->barangMentah;
          $barangMentah->stok = ($barangMentah->stok + $barangMentahDipakai->jumlah);
          $barangMentah->save();
        }

        $pembuatan->barangMentahDipakai()->delete();
        $pembuatan->delete();
      });    

      return redirect()->route('pembuatan.index')->with('success', 'Pembuatan berhasil dihapus');
    }

    public function search(Request $request){
      $searchTerm = $request->input('search');
      $pembuatans = Pembuatan::with('barangJadi')
      ->when($searchTerm, function($query, $searchTerm){
        $query->whereHas('barangJadi', function($q) use ($searchTerm){
          $q->where('nama', 'LIKE', "%{$searchTerm}%");
        });
        
      })
      ->orderByDesc('id')
      ->paginate(15)
      ->withQueryString();
      
      return view('buat.search', compact('pembuatans', 'searchTerm'));
    }
}
