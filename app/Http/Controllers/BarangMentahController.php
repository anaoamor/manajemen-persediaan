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
      return view('barang-mentah.index', [
        'barangMentahs' => DB::table('barang_mentahs')->paginate(15)
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-mentah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'kode_item' => 'required|string',  
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'satuan_hitung' => 'required|string',
            'stok' => 'required|integer',
            'ukuran' => 'required|string',
            'harga' => 'required|numeric',
        ]);
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
