<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Penjualan;
use App\Models\Sampah;
use App\Models\Setoran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    // Menghasilkan PDF laporan sampah dan setoran
    public function generatePdf()
    {
        $sampahs=Sampah::all();
        $setoransQuery = Setoran::all();

        $pdf = Pdf::loadView('dashboard-admin.setoran.laporan', compact('sampahs', 'setoransQuery'))->setPaper('a4', 'potrait'); // Menghasilkan PDF di view 'dashboard-admin.setoran.laporan'
        return $pdf->download('laporan-sampah.pdf'); // Mendownload PDF dengan nama 'laporan-sampah.pdf'
    }

    public function laporanSaldo()
    {
        // Mengambil data setoran yang dikelompokkan berdasarkan tanggal dan dihitung kredit setoran dan setor
        $setorans = Setoran::selectRaw('DATE(tanggal) as tanggal_setoran, SUM(jumlah_setoran) as kredit, SUM(setor) as setor')
            ->groupBy('tanggal_setoran')
            ->orderBy('tanggal_setoran')
            ->get();

        // Mengambil data penarikan yang dikelompokkan berdasarkan tanggal dan dihitung kredit
        $penarikans = Penarikan::selectRaw('DATE(tanggal) as tanggal_penarikan, SUM(jumlah) as kredit')
            ->groupBy('tanggal_penarikan')
            ->orderBy('tanggal_penarikan')
            ->get();

        // Mengambil data penjualan yang dikelompokkan berdasarkan tanggal dan dihitung debit dan jumlah barang
        $penjualans = Penjualan::selectRaw('DATE(tanggal) as tanggal_penjualan, SUM(price * banyak_barang) as debit, SUM(banyak_barang) as banyak_barang')
            ->groupBy('tanggal_penjualan')
            ->orderBy('tanggal_penjualan')
            ->get();

        $laporan = [];

        // Loop melalui data setoran dan menambahkan data penjualan jika tersedia
        foreach ($setorans as $setoran) {
            $debit = $penjualans->firstWhere('tanggal_penjualan', $setoran->tanggal_setoran);
            $penarikan = $penarikans->firstWhere('tanggal_penarikan', $setoran->tanggal_setoran);
            $kredit = $setoran->kredit + ($penarikan ? $penarikan->kredit : 0);
            $laporan[] = [
                'tanggal_setoran' => $setoran->tanggal_setoran,
                'tanggal_penjualan' => $debit ? $debit->tanggal_penjualan : null, // If there's a sale, show date
                'tanggal_penarikan' => $penarikan ? $penarikan->tanggal_penarikan : null, // If there's a withdrawal, show date
                'setor' => $setoran->setor,
                'kredit' => $kredit,
                'debit' => $debit ? $debit->debit : 0,  // If no debit, set 0
                'banyak_barang' => $debit ? $debit->banyak_barang : 0,
                'saldo' => $kredit - ($debit ? $debit->debit : 0),  // Balance = Credit - Debit
            ];
        }

        // Loop melalui data penjualan dan menambahkan baris jika tidak ada setoran yang sesuai
        foreach ($penjualans as $penjualan) {
            $setoran = $setorans->firstWhere('tanggal_setoran', $penjualan->tanggal_penjualan);
            $penarikan = $penarikans->firstWhere('tanggal_penarikan', $penjualan->tanggal_penjualan);

            if (!$setoran) {
                $laporan[] = [
                    'tanggal_setoran' => null, 
                    'tanggal_penjualan' => $penjualan->tanggal_penjualan,
                    'tanggal_penarikan' => $penarikan ? $penarikan->tanggal_penarikan : null,
                    'setor' => null,
                    'kredit' => 0, 
                    'debit' => $penjualan->debit,
                    'banyak_barang' => $penjualan->banyak_barang,
                    'saldo' => $penjualan->debit, 
                ];
            }
        }

        // Loop melalui data penarikan dan menambahkan baris jika tidak ada setoran atau penjualan yang sesuai
        foreach ($penarikans as $penarikan) {
            $setoran = $setorans->firstWhere('tanggal_setoran', $penarikan->tanggal_penarikan);
            $penjualan = $penjualans->firstWhere('tanggal_penjualan', $penarikan->tanggal_penarikan);

            if (!$setoran && !$penjualan) {
                $laporan[] = [
                    'tanggal_setoran' => null,
                    'tanggal_penjualan' => null,
                    'tanggal_penarikan' => $penarikan->tanggal_penarikan,
                    'setor' => null,
                    'kredit' => $penarikan->kredit,
                    'debit' => 0,
                    'saldo' => $penarikan->debit,
                ];
            }
        }

        // Mengurutkan laporan berdasarkan tanggal setoran, penjualan, atau penarikan
        usort($laporan, function ($a, $b) {
            return strtotime($a['tanggal_setoran'] ?: $a['tanggal_penjualan'] ?: $a['tanggal_penarikan']) - strtotime($b['tanggal_setoran'] ?: $b['tanggal_penjualan'] ?: $b['tanggal_penarikan']);
        });

        // Generate PDF
        $pdf = Pdf::loadView('dashboard-admin.laporan', compact('laporan'))->setPaper('a4', 'portrait');
        return $pdf->download('laporanSaldo.pdf'); // Mendownload PDF dengan nama 'laporanSaldo.pdf'
    }

    
    
}
