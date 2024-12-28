<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembelianItemController; // Tambahkan namespace controller Anda
use App\Http\Controllers\PembelianController; // Tambahkan namespace controller PembelianController

// Rute default
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menyimpan data pembelian items
Route::post('/admin/pembelian-items', [PembelianItemController::class, 'store'])->name('pembelian-items.store');

// Route untuk menampilkan form pembelian
Route::get('/pembelians/create', function () {
    return view('pembelians.create');
})->name('pembelians.create');

// Route untuk menyimpan data pembelian
Route::post('/pembelians', [PembelianController::class, 'store'])->name('pembelians.store');
