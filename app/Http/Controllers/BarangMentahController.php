<?php

namespace App\Http\Controllers;

use App\Models\BarangMentah;
use App\Models\Kategori;
use App\Models\Pemasok;
use DB;
use Illuminate\Http\Request;

class BarangMentahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $barangMentahs = BarangMentah::with('kategori')->orderByDesc('id')->paginate(15);
      return view('barang-mentah.index',compact('barangMentahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-mentah.create', [
          'pemasoks' => Pemasok::orderByDesc('id')->get(),
          'kategoris' => Kategori::orderByDesc('id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
       $validatedData = $request->validate([ 
            'kode_item' => 'required|string',  
            'nama_barang' => 'required|string',
            'id_kategori' => 'required|exists:kategoris,id',
            'satuan_hitung' => 'required|in:Batang,Lembar,Kaleng,Buah,Kg',
            'stok' => 'required|integer',
            'ukuran' => 'required|string',
            'harga_per_satuan' => 'required|numeric|min:0',
            'id_supplier' => 'exists:pemasoks,id',
        ]);

        $barangMentah = BarangMentah::create([
          'kode_item' => $validatedData['kode_item'],
          'nama' => $validatedData['nama_barang'],
          'stok' => $validatedData['stok'],
          'ukuran' => $validatedData['ukuran'],
          'id_kategori' => $validatedData['id_kategori'],
          'satuan_hitung' => $validatedData['satuan_hitung'],
          'id_pemasoks' => $validatedData['id_supplier'],
          'waktu' => now(),
          'harga_satuan' => $validatedData['harga_per_satuan'],
        ]);
        
        return redirect()->route('barang-mentah.index')->with('tambah success', 'Barang mentah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $barangMentah = BarangMentah::find($id);
      $kategori = $barangMentah->kategori;
      $pemasok = $barangMentah->pemasok;
      
        return view('barang-mentah.show', 
          compact('barangMentah', 'kategori', 'pemasok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $barangMentah = BarangMentah::findOrFail($id);
      $kategoriTerpilih = Kategori::findOrFail($barangMentah->kategori->id);
      $pemasokTerpilih = Pemasok::findOrFail($barangMentah->pemasok->id);
      $kategoris = Kategori::orderByDesc('id')->get();
      $pemasoks = Pemasok::orderByDesc('id')->get();

        return view('barang-mentah.edit', compact('barangMentah', 'kategoriTerpilih', 'pemasokTerpilih', 'pemasoks', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validatedData = $request->validate([
        'kode_item' => 'required|string',  
        'nama_barang' => 'required|string',
        'id_kategori' => 'required|exists:kategoris,id',
        'satuan_hitung' => 'required|in:Batang,Lembar,Kaleng,Buah,Kg',
        'stok' => 'required|integer',
        'ukuran' => 'required|string',
        'harga_per_satuan' => 'required|numeric|min:0',
        'id_supplier' => 'exists:pemasoks,id',
      ]);

      $barangMentah = BarangMentah::findOrFail($id);

      $barangMentah->update([
        'kode_item' => $request->kode_item,
        'nama' => $request->nama_barang,
        'id_kategori' => $request->id_kategori,
        'satuan_hitung' => $request->satuan_hitung,
        'stok' => $request->stok,
        'ukuran' => $request->ukuran,
        'id_pemasoks' => $request->id_supplier,
        'harga_satuan' => $request->harga_per_satuan,
      ]);

      return redirect()->route('barang-mentah.index')->with('edit success', 'Barang mentah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangMentah = BarangMentah::findOrFail($id)->delete();

        return redirect()->route('barang-mentah.index')->with('success', 'Barang mentah berhasil dihapus');
    }

    public function search(Request $request)
    {
      $searchTerm = $request->input('search');
      $barangMentahs = BarangMentah::with('kategori')
      ->when($searchTerm, function($query, $searchTerm){
        $query->where('nama', 'LIKE', "%{$searchTerm}%");
      })
      ->orderByDesc('id')
      ->paginate(15)
      ->withQueryString();
      
      return view('barang-mentah.search', compact('barangMentahs', 'searchTerm'));
    }
}
