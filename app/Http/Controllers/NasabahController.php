<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    // Menampilkan daftar nasabah dengan paginasi
    public function index()
    {
        $nasabahs = Nasabah::latest();
        return view('dashboard-admin.nasabah.index', ['nasabahs' => $nasabahs->paginate(10)]);
        
    }

    // Menampilkan form pembuatan nasabah baru
    public function create()
    {
        return view('dashboard-admin.nasabah.create');
    }

    // Menyimpan data nasabah yang baru dibuat
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'no_induk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jumlah_orang_kk' => 'required|integer',
        ]);

        Nasabah::create($validated); // Menyimpan data nasabah baru ke dalam database
        return redirect()->route('nasabah.index')->with('pesan', 'Data berhasil di tambahkan');
    }

    // Menampilkan form edit nasabah berdasarkan ID
    public function edit($id)
    {
        $dataNasabah = Nasabah::findOrFail($id);
        return view('dashboard-admin.nasabah.edit', compact('dataNasabah'));
    }

    // Memperbarui data nasabah yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input form update
        $request->validate([
            'no_induk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jumlah_orang_kk' => 'required|integer',
        ]);

        $dataNasabah = Nasabah::findOrFail($id);
        $dataNasabah->update($request->all());
        $dataNasabah->save();
        return redirect()->route('nasabah.index')->with('success', 'Data sampah berhasil diperbarui.');
    }

    // Fungsi untuk menghapus data nasabah
    public function destroy($id)
    {
        $setoranCount = Setoran::where('nama_nasabah', $id)->count(); // Mengecek apakah nasabah memiliki setoran

        if ($setoranCount > 0) {
            // Jika nasabah memiliki setoran, tidak bisa dihapus
            return redirect()->route('nasabah.index')->with('error', 'Nasabah tidak bisa dihapus karena masih memiliki setoran.');
        }

        Nasabah::destroy($id);
        return redirect('/nasabah')->with('success', 'Data berhasil dihapus');
    }

    // Fungsi untuk menampilkan detail nasabah
    public function show($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return response()->json($nasabah);
    }

    // Fungsi untuk menampilkan semua data nasabah
    public function showAll()
    {
        $nasabah = Nasabah::all();
        return response()->json($nasabah);
    }
}
