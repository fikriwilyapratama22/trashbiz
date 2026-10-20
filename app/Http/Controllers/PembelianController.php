<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class PembelianController extends Controller
{
    // Menampilkan dashboard pembeli
    public function DashboardPembeli(Request $request)
    {
        $penjualan = Penjualan::where('pembeli', Auth::user()->nama)->get(); // Mengambil data penjualan yang terkait dengan pembeli yang login
        return view('dashboard-pembeli.dashboardPembeli', compact('penjualan'));
    }

    // Menampilkan halaman produk yang tersedia untuk dibeli
    public function produk()
    {
        $penjualan = Penjualan::with('produk')->get(); // Mengambil semua data penjualan yang berhubungan dengan produk
        return view('dashboard-pembeli.pembelian.produk', compact('penjualan'));
    }
    
    // Menampilkan form pembelian produk
    public function create(Request $request)
    {
        $produk = Produk::all();
        // Mengambil data produk dan harga yang dipilih dari query string
        $produk_selected = $request->query('produk');
        $price_selected = $request->query('price'); 
        return view('dashboard-pembeli.pembelian.create', compact('produk', 'produk_selected', 'price_selected'));
    }
    
    // Menyimpan data pembelian produk
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'pembeli' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'produk' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|in:cod,transfer',
            'banyak_barang' => 'required|integer|min:1',
        ]);

        // Menyimpan data pembelian ke dalam tabel Penjualan
        Penjualan::create([
            'pembeli' => $validatedData['pembeli'],
            'tanggal' => $validatedData['tanggal'],
            'produk' => $validatedData['produk'],
            'price' => $validatedData['price'],
            'no_telp' => $validatedData['no_telp'],
            'alamat' => $validatedData['alamat'],
            'banyak_barang' => $validatedData['banyak_barang'],
            'metode_pembayaran' => $validatedData['metode_pembayaran'],
            'user_id' => Auth::id(),
        ]);

        // Mengarahkan pengguna ke halaman sesuai levelnya dengan pesan sukses
        if (Auth::user()->level === 'Pembeli') {
            // Jika yang login adalah pembeli
            return redirect()->route('dashboard-pembeli')->with('success', 'Pembelian produk berhasil ditambahkan!');
        } elseif (Auth::user()->level === 'Nasabah') {
            // Jika yang login adalah nasabah
            return redirect()->route('dashboard-nasabah')->with('success', 'Pesanan berhasil ditambahkan!');
        }
    }
}
