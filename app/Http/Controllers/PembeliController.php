<?php

namespace App\Http\Controllers;

use App\Models\BarangJadi;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $pembelis = Pembeli::orderByDesc('id')
      ->paginate(15);
        return view('pembeli.index', compact('pembelis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembeli.create');
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

        $pembeli = Pembeli::create([
          'nama' => $request->input('nama'),
          'no_telepon' => $request->input('no_telepon'),
          'alamat' => $request->input('alamat')
        ]);

        return redirect()->route('pembeli.index')->with('tambah success', 'Pembeli berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembeli = Pembeli::findOrFail($id);
        return view('pembeli.show', compact('pembeli'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembeli = Pembeli::findOrFail($id);
        return view('pembeli.edit', compact('pembeli'));
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

        $pembeli = Pembeli::findOrFail($id)
        ->update([
          'nama' => $request->input('nama'),
          'no_telepon' => $request->input('no_telepon'),
          'alamat' => $request->input('alamat'),
        ]);

        return redirect()->route('pembeli.index')->with('edit success', 'Identitas pembeli berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembeli = Pembeli::findOrFail($id)->delete();
        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil dihapus');
    }

    public function search(Request $request){
      $searchTerm = $request->input('search');
      $pembelis = Pembeli::when($searchTerm, function($query, $searchTerm){
        $query->where('nama', 'LIKE', "%{$searchTerm}%");
      })->orderByDesc('id')
      ->paginate(15)
      ->withQueryString();
      
      return view('pembeli.search', compact('pembelis', 'searchTerm'));
    }
}
