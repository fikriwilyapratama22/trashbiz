<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Menampilkan data users
    public function index()
    {
        $users = User::latest(); // Mengambil semua data dari tabel users dan mengurutkan berdasarkan waktu terbaru 
        return view('dashboard-admin.admin.index', ['users' => $users->paginate(10)]); // Mengirimkan data users ke view
    }

    // Menampilkan form pembuatan data pengguna baru
    public function create()
    {
        return view('dashboard-admin.admin.create'); 
    }

    public function store(Request $request)
    {
        // Memvalidasi data yang diterima dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255',
            'no_hp_wa' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
       
        User::create($validated);  // Menyimpan data pengguna baru ke tabel `users` setelah divalidasi
        return redirect()->route('admin.index')->with('pesan', 'Data berhasil di tambahkan'); // Mengarahkan kembali ke halaman index admin
    }

    public function edit($id)
    {
        $dataAdmin = User::findOrFail($id); // Mengambil data pengguna berdasarkan ID,
        return view('dashboard-admin.admin.edit', compact('dataAdmin')); // Mengirimkan data pengguna yang akan diedit ke view edit
    }

    public function update(Request $request, $id)
    {
        // Memvalidasi data yang diterima dari form edit
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'alamat' => 'required|string|max:255',
            'no_hp_wa' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $dataAdmin = User::findOrFail($id); // Mengambil data pengguna berdasarkan ID.
        $dataAdmin->update($request->all()); // Memperbarui data pengguna dengan data yang baru.
        $dataAdmin->save(); // Menyimpan perubahan yang telah diperbarui.
        return redirect()->route('admin.index')->with('success', 'Data sampah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::destroy($id); // Menghapus data pengguna berdasarkan ID.
        return redirect('/admin')->with('success', 'Data berhasil di hapus');
    }
}
