<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Order;
use App\Models\Penarikan;
use App\Models\Penjualan;
use App\Models\Sampah;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardNasabah extends Controller
{
    // Menampilkan informasi dashboard nasabah
    public function DashboardNasabah(Request $request)
    {
        $setoransQuery = Setoran::with('nasabah')->latest(); // Mengambil data setoran dengan relasi ke model Nasabah yang diurutkan berdasarkan tanggal terbaru
        $totalPenarikan = Penarikan::where('user_id', auth()->id()) // Menghitung total penarikan yang diterima admin sesuai nasabah yang login
            ->where('status', 'Diterima')
            ->sum('jumlah');
        $setorans = $setoransQuery->get()
            ->groupBy(function ($item) {
                return $item->nasabah->nama . '|' . $item->tanggal; // Mengelompokkan setoran berdasarkan nama nasabah dan tanggal
            })
            ->map(function ($group) {
                // Kelompok data dibuat menjadi array
                return [
                    'nasabah' => $group->first()->nasabah->nama,
                    'tanggal' => $group->first()->tanggal,
                    'jumlah_setoran' => $group->sum('setor'),
                    'total_setoran' => $group->sum('jumlah_setoran'),
                    'id' => $group->pluck('id')->first(),
                ];
            })
            ->values();

        $penjualan = Penjualan::where('pembeli', Auth::user()->nama)->get(); // Mengambil data penjualan yang dilakukan oleh nasabah yang sedang login
        return view('dashboard_nasabah.dashboardnasabah', compact('setorans', 'totalPenarikan', 'penjualan')); // Menampilkan dashboard nasabah
    }
}
