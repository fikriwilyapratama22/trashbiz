@extends('layouts.main')
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <!-- Header Modal -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Formulir Pembelian</h3>
                </div>

                <!-- Formulir Pembelian -->
                <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Menampilkan pesan error jika ada kesalahan validasi -->
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        
                    <!-- Field Nama Pembeli -->
                    <div class="mb-4">
                        <label for="pembeli" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                        <!-- Input untuk menampilkan nama pembeli yang sudah terautentikasi (readonly) -->
                        <input type="text" id="pembeli" name="pembeli" value="{{ Auth::user()->nama }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly>
                    </div>
                    
                    <!-- Field Produk -->
                    <div class="mb-4">
                        <label for="produk" class="block text-sm font-medium text-gray-700">Produk</label>
                        <!-- Input untuk menampilkan nama produk yang dipilih sebelumnya (readonly) -->
                        <input type="text" id="produk" name="produk" value="{{ old('produk', $produk_selected) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly required>
                    </div>                  

                    <!-- Field Harga -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <!-- Input untuk menampilkan harga produk yang dipilih (readonly) -->
                        <input type="text" id="price" name="price" value="{{ old('price', $price_selected) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly required>
                    </div>

                    <!-- Field Nomor WA -->
                    <div class="mb-4">
                        <label for="no_telp" class="block text-sm font-medium text-gray-700">Nomor WA</label>
                        <!-- Input untuk nomor WhatsApp pembeli, dengan nilai default nomor pengguna yang sudah terautentikasi -->
                        <input type="text" id="no_telp" name="no_telp" value="{{ Auth::user()->no_hp_wa }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    </div>

                    <!-- Field Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <!-- Textarea untuk alamat pengiriman -->
                        <textarea id="alamat" name="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>{{ Auth::user()->alamat }}</textarea>
                    </div>

                    <!-- Field Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <!-- Input untuk memilih tanggal pembelian, default ke tanggal sekarang -->
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::now()->toDateString()) }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    </div>

                    <!-- Field Banyak Barang -->
                    <div class="mb-4">
                        <label for="banyak_barang" class="block text-sm font-medium text-gray-700">Banyak Barang</label>
                        <!-- Input untuk memasukkan jumlah barang yang ingin dibeli -->
                        <input type="number" id="banyak_barang" name="banyak_barang" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    </div>

                    <!-- Field Metode Pembayaran -->
                    <div class="mb-4">
                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <!-- Dropdown untuk memilih metode pembayaran (COD atau Transfer) -->
                        <select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                            <option value="cod">Cash on Delivery (COD)</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <!-- Tombol Simpan untuk mengirimkan formulir -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
