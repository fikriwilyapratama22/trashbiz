@extends('layouts.main')

<div class="fixed z-50 inset-0">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <!-- Formulir modal yang berisi form untuk mengedit pembelian -->
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <!-- Header bagian modal -->
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-2xl leading-6 font-bold text-primary">Formulir Edit Pembelian</h3>
            </div>
            
            <!-- Formulir untuk mengedit pembelian -->
            <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')  <!-- Menambahkan metode PUT untuk melakukan update -->
                
                <!-- Input untuk Nama Pembeli -->
                <div class="mb-4">
                    <label for="pembeli" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                    <input type="text" id="pembeli" name="pembeli" value="{{ old('pembeli', $penjualan->pembeli) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                </div>
                
                <!-- Input untuk Nama Produk (Read-Only) -->
                <div class="mb-4">
                    <label for="produk" class="block text-sm font-medium text-gray-700">Produk</label>
                    <input type="text" id="produk" name="produk" value="{{ old('produk', $penjualan->produk) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly required>
                </div>

                <!-- Input untuk Harga Produk (Read-Only) -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="text" id="price" name="price" value="{{ old('price', $penjualan->price) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly required>
                </div>

                <!-- Input untuk Nomor Telepon -->
                <div class="mb-4">
                    <label for="no_telp" class="block text-sm font-medium text-gray-700">Nomor WA</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $penjualan->no_telp) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                </div>

                <!-- Input untuk Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>{{ old('alamat', $penjualan->alamat) }}</textarea>
                </div>

                <!-- Input untuk Banyak Barang -->
                <div class="mb-4">
                    <label for="banyak_barang" class="block text-sm font-medium text-gray-700">Banyak Barang</label>
                    <input type="number" id="banyak_barang" name="banyak_barang" value="{{ old('banyak_barang', $penjualan->banyak_barang) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                </div>

                <!-- Dropdown untuk Metode Pembayaran -->
                <div class="mb-4">
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                        <option value="cod" {{ old('metode_pembayaran', $penjualan->metode_pembayaran) == 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                        <option value="transfer" {{ old('metode_pembayaran', $penjualan->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                </div>

                <!-- Tombol untuk Menyimpan Perubahan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
