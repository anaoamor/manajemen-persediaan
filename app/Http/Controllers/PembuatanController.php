<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\BarangMentah;
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

      DB::transaction(function(){
        $pembuatan = Pembuatan::create([
          'waktu' => now(),
          'jumlah' => 10,
          'status' => 'Proses',
        ]);

        $pembuatan->barangJadi()->create([
          'id_kategori_perabot' => 1,
          'nama' => 'Lemari',
          'jumlah' => 10,
        ]);
        
      });
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buat.create', [
          'kategoris' => KategoriPerabot::get(),
          'barangMentahs' => BarangMentah::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
