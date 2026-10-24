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

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil ditambahkan');

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
