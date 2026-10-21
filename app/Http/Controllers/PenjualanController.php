<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {

    }

    public function show(Request $request, Penjualan $penjualan)
    {
        return view('penjualan.show', ['penjualan' => $penjualan]);
    }

    public function edit(Request $request, Penjualan $penjualan)
    {
        return view('penjualan.edit', ['penjualan' => $penjualan]);
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        
    }
}
