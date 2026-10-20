<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Penarikan;
use App\Models\Penjualan;
use App\Models\Setoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $jumlahNasabah = Nasabah::count();
        $totalPenjualan = Penjualan::selectRaw('SUM(price * banyak_barang) as total')->value('total');
        $totalSaldo = Setoran::sum('jumlah_setoran');
        $totalSampahTerkumpul = Setoran::sum('setor');
        $totalPenarikan = Penarikan::where('status', 'Diterima')
            ->sum('jumlah'); // Menghitung total penarikan yang statusnya 'Diterima' dengan menjumlahkan jumlah penarikan
        
        $saldoAkhir = $totalSaldo - $totalPenarikan; // Menghitung saldo akhir dengan mengurangi total saldo dengan total penarikan

        // Mengembalikan tampilan dashboard dengan data yang telah dihitung
        return view('dashboard-admin.dashboard', [
            'jumlahNasabah' => $jumlahNasabah,
            'totalPenjualan' => $totalPenjualan,
            'totalSaldo' => $totalSaldo,
            'saldoAkhir' => $saldoAkhir,
            'totalSampahTerkumpul' => $totalSampahTerkumpul,
        ]);
    }

}
