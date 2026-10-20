<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        CartItem::create([
            'user_id' => auth()->id(),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => 1,
        ]);

        return redirect()->route('cart.view')->with('success', 'Barang ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        return view('dashboard-pembeli.cart.index', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            return redirect()->route('cart.index')->with('error', 'Jumlah tidak dapat kurang dari 1.');
        }

        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->route('cart.view')->with('success', 'Keranjang berhasil diperbarui');
    }

    public function create()
    {
        $produk = Produk::all();
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        return view('dashboard-pembeli.cart.create', compact('cartItems','produk'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'pembeli' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|in:cod,transfer',
        ]);

        foreach ($request->quantities as $item_id => $quantity) {
            // Ambil data produk berdasarkan nama produk yang ada di CartItem
            $cartItem = CartItem::find($item_id);
            $produk = Produk::where('nama', $cartItem->product_name)->first();

            if (!$produk) {
                return redirect()->back()->withErrors(["Produk dengan nama {$cartItem->product_name} tidak ditemukan."]);
            }

            // Simpan data penjualan
            Penjualan::create([
                'tanggal' => now(),
                'produk' => $produk->nama,
                'price' => $produk->harga,
                'banyak_barang' => $quantity,
                'metode_pembayaran' => $request->metode_pembayaran,
                'pembeli' => $request->pembeli,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'user_id' => Auth::id(),
            ]);
        }

        // Hapus cart setelah pemesanan berhasil
        CartItem::where('user_id', Auth::id())->delete();
        return redirect()->route('dashboard-pembeli')->with('success', 'Pembelian berhasil!');
    }

}
