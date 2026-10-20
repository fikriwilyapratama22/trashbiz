<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarikSaldoController extends Controller
{
    // Menampilkan daftar penarikan saldo untuk nasabah yang sedang login
    public function index()  
    {
        // Mengambil semua penarikan yang terkait dengan user yang sedang login
        $penarikans = Penarikan::with('user') 
        ->where('user_id', auth()->user()->id)
        ->get();
        return view('dashboard_nasabah.tarik_saldo.index', compact('penarikans'));
    }

    // Menampilkan daftar penarikan saldo untuk semua nasabah (admin)
    public function index2()  
    {
        $penarikans = Penarikan::with('user')->get();
        return view('dashboard-admin.tarik_saldo.index', compact('penarikans'));
    }

    // Menampilkan form untuk mengajukan penarikan saldo
    public function create()
    {
        return view('dashboard_nasabah.tarik_saldo.create');
    }

    // Menyimpan data penarikan saldo baru
    public function store(Request $request)
    {
        // Validate input dari form
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);
        
        $user_id = Auth::id(); // Mengambil ID user yang sedang login

        // Membuat data penarikan baru
        Penarikan::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'user_id' => $user_id, // Store the authenticated user's ID
        ]);
        return redirect()->route('tarik_saldo.index')->with('success', 'Penarikan berhasil diajukan!');
    }

    // Mengupdate status penarikan (admin)
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Diterima,Ditolak', // pastikan hanya status yang valid
        ]);

        // Mencari data penarikan berdasarkan ID
        $penarikan = Penarikan::findOrFail($id);

        // Mengupdate status penarikan
        $penarikan->status = $validated['status'];
        $penarikan->save();

        // Redirect to the list with a success message
        return redirect()->route('tarik_saldo2.index2')
            ->with('status', 'Penarikan berhasil diperbarui');
    }
}
