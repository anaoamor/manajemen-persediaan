<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pemasok.index', [
          'pemasoks' => Pemasok::orderByDesc('id')->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemasok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'nama' => 'required|string',
          'no_telepon' => 'required|numeric',
          'alamat' => 'required|string',
        ]);

        $pemasok = Pemasok::create([
          'nama' => $validatedData['nama'],
          'no_telepon' => $validatedData['no_telepon'],
          'alamat' => $validatedData['alamat'],
        ]);

        return redirect()->route('pemasok.index')->with('tambah success', 'Pemasok berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pemasok.show', [
          'pemasok' => Pemasok::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pemasok.edit', [
          'pemasok' => Pemasok::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
          'nama' => 'required|string',
          'no_telepon' => 'required|numeric',
          'alamat' => 'required|string',
        ]);

        $pemasok = Pemasok::findOrFail($id);

        $pemasok->nama = $request->nama;
        $pemasok->no_telepon = $request->no_telepon;
        $pemasok->alamat = $request->alamat;
        $pemasok->save();
        $pemasok->update();

        return redirect()->route('pemasok.index')->with('edit success', 'Pemasok berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemasok = Pemasok::findOrFail($id)->delete();
        
        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil dihapus');
    }

    public function search(Request $request){
      $searchTerm = $request->input('search');
      
      $pemasoks = Pemasok::query()
      ->when($searchTerm, function($query, $searchTerm){
        $query->where(function ($query) use ($searchTerm){
          $query->where('nama', 'LIKE', "%{$searchTerm}%");
        });
      })
      ->orderByDesc('id')
      ->paginate()
      ->withQueryString();

      return view('pemasok.search', compact('pemasoks', 'searchTerm'));
    }
}
