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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
