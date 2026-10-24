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
          'pemasoks' => Pemasok::get(),
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
            'kategori' => 'required|string',
            'satuan_hitung' => 'required|string',
            'stok' => 'required|integer',
            'ukuran' => 'required|string',
            'harga_per_satuan' => 'required|numeric|min:0',
            'nama' => 'string',
            'no_telepon' => 'numeric|max:15',
            'alamat' => 'string',
        ]);
        
        DB::transaction(function() use ($validatedData)
        {
          $kategori = Kategori::create([
            'nama' => $validatedData['kategori'],
          ]);
          
          $kategori->barangMentah()->create([
            'kode_item' => $validatedData['kode_item'],
            'nama' => $validatedData['nama_barang'],
            'satuan_hitung' => $validatedData['satuan_hitung'],
            'stok' => $validatedData['stok'],
            'ukuran' => $validatedData['ukuran'],
            'waktu' => now(),
            'harga_satuan' => $validatedData['harga_per_satuan'],
          ]);
        }); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
