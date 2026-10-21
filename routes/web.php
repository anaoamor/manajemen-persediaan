<?php

use App\Http\Controllers\BarangJadiController;
use App\Http\Controllers\PembuatanController;
use App\Http\Controllers\PenjualanController;
use App\Models\BarangMentah;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang-mentah/index', [BarangMentah::class, 'index'])->name('barang-mentah.index');
Route::get('/barang-mentah/create', [BarangMentah::class, 'create'])->name('barang-mentah.create');
Route::post('/barang-mentah/store', [BarangMentah::class, 'store'])->name('barang-mentah.store');
Route::get('/barang-mentah/show/{id}', [BarangMentah::class, 'show'])->name('barang-mentah.show');
Route::get('/barang-mentah/edit/{id}', [BarangMentah::class, 'edit'])->name('barang-mentah.edit');
Route::put('/barang-mentah/update/{id}', [BarangMentah::class, 'update'])->name('barang-mentah.update');
Route::delete('/barang-mentah/destroy/{id}', [BarangMentah::class, 'destroy'])->name('barang-mentah.destroy');

Route::get('/barang-jadi/index', [BarangJadiController::class, 'index'])->name('barang-jadi.index');
Route::get('/barang-jadi/show/{id}', [BarangJadiController::class, 'show'])->name('barang-jadi.show');

Route::get('/pembuatan/index', [PembuatanController::class, 'index'])->name('pembuatan.index');
Route::get('/pembuatan/create', [PembuatanController::class, 'create'])->name('pembuatan.create');
Route::post('/pembuatan/store', [PembuatanController::class, 'store'])->name('pembuatan.store');
Route::get('/pembuatan/show/{id}', [PembuatanController::class, 'show'])->name('pembuatan.show');
Route::get('/pembuatan/edit/{id}', [PembuatanController::class, 'edit'])->name('pembuatan.edit');
Route::put('/pembuatan/update/{id}', [PembuatanController::class, 'update'])->name('pembuatan.update');
Route::delete('/pembuatan/destroy/{id}', [PembuatanController::class, 'destroy'])->name('pembuatan.destroy');

Route::get('/penjualan/index', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/show/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/update/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
Route::delete('/penjualan/destroy/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');