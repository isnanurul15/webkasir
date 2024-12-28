<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianItem; // Import model PembelianItem

class PembelianItemController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tanggal_pembelian' => 'required|date',
            'supplier' => 'required|string|max:255',
            'email_supplier' => 'required|email',
            'barang' => 'required|string',
            'harga_barang' => 'required|numeric',
            'jumlah_barang' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        // Simpan data ke database
        PembelianItem::create($validatedData);

        // Redirect atau respon setelah berhasil
        return redirect()->route('pembelian-items.index')->with('success', 'Data berhasil disimpan!');
    }
}
