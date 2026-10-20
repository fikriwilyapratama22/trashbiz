<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Sampah;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranController extends Controller
{
    // Menampilkan daftar setoran 
    public function index(Request $request)
    {
        $setoransQuery = Setoran::with('nasabah', 'sampah')->latest(); // Mengambil data setoran dan menghubungkannya dengan Nasabah dan Sampah
        $setorans = $setoransQuery->paginate(10); // Ambil data setoran yang sudah difilter dan paginasi
        $setoransGrouped = $setorans->groupBy(function ($item) {
            return $item->nasabah->nama;
        }); // Mengelompokkan setoran berdasarkan nama nasabah

        return view('dashboard-admin.setoran.index', ['setorans' => $setoransGrouped]);
    }

    // Menampilkan form untuk menambah data setoran
    public function create()
    {
        // Mengambil data Nasabah dan Sampah yang tersedia untuk form input setoran
        $nasabahs = Nasabah::all();
        $sampahs = Sampah::all();
        return view('dashboard-admin.setoran.create', compact('nasabahs', 'sampahs'));
    }

    // Menyimpan data setoran baru ke database
    public function store(Request $request)
    {
        // Validasi input data setoran
        $validated = $request->validate([
            'nama_nasabah' => 'required|exists:nasabahs,id',
            'jenis_sampah' => 'required|exists:sampahs,id',  
            'tanggal' => 'required|date',
            'setor' => 'required|numeric|min:0',
        ]);

        // Mengambil harga sampah berdasarkan jenis sampah yang dipilih
        $harga = Sampah::find($validated['jenis_sampah'])->harga;
        
        // Menyimpan data setoran ke dalam database
        Setoran::create([
            'nama_nasabah' => $validated['nama_nasabah'],
            'jenis_sampah' => $validated['jenis_sampah'],
            'tanggal' => $validated['tanggal'],
            'setor' => $validated['setor'],
            'jumlah_setoran' => $validated['setor'] * $harga,
        ]);

        return redirect()->route('setoran.index')->with('pesan', 'Data berhasil ditambahkan');
    }  
    
    // Menampilkan form untuk mengedit data setoran
    public function edit($id)
    {
        $dataSetoran = Setoran::with(['nasabah', 'sampah'])->findOrFail($id); // Mengambil data setoran berdasarkan ID beserta data nasabah dan sampah
        $nasabahs = Nasabah::all(); 
        $sampahs = Sampah::all(); 
        return view('dashboard-admin.setoran.edit', compact('dataSetoran', 'nasabahs', 'sampahs')); 
    }

    // Memperbarui data setoran setelah diedit
    public function update(Request $request, $id)
    {
        $dataSetoran = Setoran::findOrFail($id); // Mencari data setoran berdasarkan ID
        
        // Validasi input data setoran yang akan diperbarui
        $validated = $request->validate([
            'nama_nasabah' => 'required|exists:nasabahs,id', // ID Nasabah
            'jenis_sampah' => 'required|exists:sampahs,id',   // ID Jenis Sampah
            'tanggal' => 'required|date',
            'setor' => 'required|numeric|min:0',
        ]);

        // Mengambil harga sampah berdasarkan jenis sampah yang dipilih
        $harga = Sampah::find($validated['jenis_sampah'])->harga;

        // Memperbarui data setoran dengan informasi baru
        $dataSetoran->update([
            'nama_nasabah' => $validated['nama_nasabah'],
            'jenis_sampah' => $validated['jenis_sampah'],
            'tanggal' => $validated['tanggal'],
            'setor' => $validated['setor'],
            'jumlah_setoran' => $validated['setor'] * $harga,
        ]);

        return redirect()->route('setoran.index')->with('pesan', 'Data berhasil diperbarui');
    }

    // Menghapus data setoran
    public function destroy($id)
    {
        $dataSetoran = Setoran::findOrFail($id); // Mengambil data setoran berdasarkan ID dan menghapusnya
        $dataSetoran->delete();

        return redirect()->route('setoran.index')->with('pesan', 'Data berhasil dihapus');
    }

    // Menampilkan detail setoran berdasarkan ID untuk admin
    public function show($id)
    {
        $dataSetoran = Setoran::with(['nasabah', 'sampah'])
            ->where('id', $id)
            ->first();

        $groupedSetorans = Setoran::with(['sampah', 'nasabah'])
            ->where('tanggal', $dataSetoran->tanggal)
            ->whereHas('nasabah', function($query) use ($dataSetoran) {
                $query->where('nama', $dataSetoran->nasabah->nama);
            })
            ->get()
            ->groupBy(function($item) {
                return $item->nasabah->nama . '|' . $item->tanggal;
            });

        return view('dashboard-admin.setoran-detail', compact('dataSetoran', 'groupedSetorans'));
    }

    // Menampilkan detail setoran oleh nasabah
    public function showNasabah($id)
    {
        // Mengambil data setoran berdasarkan ID dan mengambil relasi 'nasabah' dan 'sampah' yang terkait dengan setoran
        $dataSetoran = Setoran::with(['nasabah', 'sampah'])
            ->where('id', $id)
            ->first();

        // Mengambil setoran lainnya dengan tanggal yang sama dan nasabah yang sama
        $groupedSetorans = Setoran::with(['sampah', 'nasabah'])
            ->where('tanggal', $dataSetoran->tanggal)
            ->whereHas('nasabah', function($query) use ($dataSetoran) {
                $query->where('nama', $dataSetoran->nasabah->nama);
            })
            ->get() // Mengambil semua setoran yang sesuai dengan kriteria
            ->groupBy(function($item) {
                // Mengelompokkan setoran berdasarkan nama nasabah dan tanggal
                return $item->nasabah->nama . '|' . $item->tanggal;
            });

        return view('dashboard_nasabah.setoran-detailNasabah', compact('dataSetoran', 'groupedSetorans'));
    }

    // Menampilkan riwayat setoran untuk admin dengan pengelompokan berdasarkan nasabah dan tanggal
    public function riwayatSetoran(Request $request)
    {
        $setoransQuery = Setoran::with('nasabah')->latest();
        $setorans = $setoransQuery->get()
            // Mengelompokkan berdasarkan nama nasabah dan tanggal setoran
            ->groupBy(function ($item) {
                return $item->nasabah->nama . '|' . $item->tanggal; 
            }) 
            // Menghitung jumlah setoran dan total setoran
            ->map(function ($group) {
                return [
                    'nasabah' => $group->first()->nasabah->nama,
                    'tanggal' => $group->first()->tanggal,
                    'jumlah_setoran' => $group->sum('setor'),
                    'total_setoran' => $group->sum('jumlah_setoran'),
                    'id' => $group->first()->id,
                ];
            })
            ->values();

        return view('dashboard-admin.riwayat-setoran', compact('setorans'));
    }
 
    public function riwayatSetoranNasabah(Request $request)
    {
        $setoransQuery = Setoran::with('nasabah')->latest();

        // Mengambil semua data setoran, mengelompokkan berdasarkan nasabah dan tanggal, lalu menghitung total setoran
        $setorans = $setoransQuery->get()
            ->groupBy(function ($item) {
                return $item->nasabah->nama . '|' . $item->tanggal;
            })
            ->map(function ($group) {
                return [
                    'nasabah' => $group->first()->nasabah->nama,
                    'tanggal' => $group->first()->tanggal,
                    'jumlah_setoran' => $group->sum('setor'),
                    'total_setoran' => $group->sum('jumlah_setoran'),
                    'id' => $group->pluck('id')->first(),
                ];
            })
            ->values();

        return view('dashboard_nasabah.riwayat-setoranNasabah', compact('setorans'));
    }
}
