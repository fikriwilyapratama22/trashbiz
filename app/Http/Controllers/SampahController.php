<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SampahController extends Controller
{
    // Menampilkan data sampah untuk admin
    public function index()
    {
        $sampahs = Sampah::all(); 
        return view('dashboard-admin.sampah.index',compact('sampahs'));
    }

    // Menampilkan data sampah untuk nasabah
    public function indexNasabah()
    {
        $sampahs = Sampah::all(); 
        return view('dashboard_nasabah.sampah',compact('sampahs'));
    }

    // Menampilkan form untuk tambah data sampah oleh admin
    public function create()
    {
        return view('dashboard-admin.sampah.create');
    }

    // Menyimpan data sampah
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName);
            $validated['gambar'] = $fileName;
        }
        
        Sampah::create($validated);
        return redirect()->route('sampah.index')->with('pesan','Data berhasil di tambahkan');
    }

    // Menampilkan form untuk edit data sampah
    public function edit($id)
    {
        $dataSampah = Sampah::findOrFail($id);
        return view('dashboard-admin.sampah.edit', compact('dataSampah'));
    }

    // Memperbarui data sampah
    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|max:2048', 
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $dataSampah = Sampah::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($dataSampah->gambar) {
                Storage::delete('public/' . $dataSampah->gambar);
            }
                $filePath = $request->file('gambar')->store('img', 'public');
                $dataSampah->gambar = $filePath;
            }

            $dataSampah->jenis = $request->jenis;
            $dataSampah->harga = $request->harga;
            $dataSampah->save();

            return redirect()->route('sampah.index')->with('success', 'Data sampah berhasil diperbarui.');
    }

    // Menghapus data sampah
    public function destroy($id)
    {
        Sampah::destroy($id);
        return redirect('/sampah')->with('pesan','Data berhasil di hapus');
    }
}
