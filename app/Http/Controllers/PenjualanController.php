<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Session;

class penjualanController extends Controller
{
    // Menampilkan data penjualan produk
    public function index()
    {
        $penjualan = Penjualan::with('produk')->get(); // Mengambil semua data penjualan beserta relasi dengan produk
        
        // Kelompokkan berdasarkan pembeli dan tanggal
        $penjualanGrouped = $penjualan->groupBy(function($item) {
        // Gabungkan pembeli dan tanggal untuk pengelompokkan
        return $item->pembeli . '|' . \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
    });
        return view('penjualan.index', compact('penjualan','penjualanGrouped'));
    }

    // Menampilkan form untuk mengedit data penjualan
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id); // Mengambil data penjualan berdasarkan ID
        return view('penjualan.edit', compact('penjualan'));
    }

    // Memperbarui data penjualan
    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());

        return redirect()->route('penjualan.index')->with('sukses', 'Data berhasil diperbarui');
    }

    // Menghapus data penjualan
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('sukses', 'Data berhasil dihapus');
    }
}
