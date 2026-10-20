<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Mengimpor facade Auth untuk menangani otentikasi pengguna

class LoginController extends Controller
{
    // Menampilkan form login nasabah
    public function showNasabahLoginForm()
    {
        return view('tampilan_login.login');
    }

    public function loginNasabah(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['user_level' => Auth::user()->level]); // Jika login berhasil, simpan level pengguna di session

            // Jika level pengguna = admin, arahkan ke dashboard admin
            if (Auth::user()->level === 'Admin') {
                return redirect()->route('dashboard-admin');
            } else {
                // Jika pengguna bukan admin, arahkan ke dashboard nasabah
                return redirect()->route('dashboard-nasabah');
            }
        }

        // Jika login gagal, kembalikan dengan pesan kesalahan
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        // Hapus data sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Logout berhasil!');;
    }
}
