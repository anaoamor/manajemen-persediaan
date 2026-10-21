<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangMentahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang-mentah.index');
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
            'stok' => 'required|integer',
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
