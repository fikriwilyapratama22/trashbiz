<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginPembeliController extends Controller
{
    // Menampilkan form login pembeli
    public function showPembeliLoginForm()
    {
        return view('tampilan_login.loginPembeli');
    }

    public function loginPembeli(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'no_hp_wa' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['no_hp_wa' => $request->no_hp_wa, 'password' => $request->password])) {
            
            if (Auth::user()->level === 'Pembeli') {
                // Jika pengguna adalah Pembeli, simpan level pengguna di sesi
                session(['user_level' => Auth::user()->level]);
                return redirect()->route('dashboard-pembeli'); // Arahkan ke dashboard pembeli
            }
        }

        // Jika login gagal, kembalikan dengan pesan kesalahan
        return back()->withErrors([
            'no_hp_wa' => 'Nomor telepon(WA) atau password salah.',
        ]);
    }
}
