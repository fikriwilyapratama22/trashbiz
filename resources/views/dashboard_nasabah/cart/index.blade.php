<x-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center">Keranjang Belanja</h1>

        <!-- Tabel yang Menampilkan Daftar Produk dalam Keranjang -->
        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <!-- Header Tabel dengan Kolom No, Nama Produk, Harga, Jumlah, dan Total -->
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nama Produk</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Harga</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop untuk Menampilkan Setiap Item yang Ada di Keranjang -->
                @foreach ($cartItems as $index => $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->product_name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex justify-center items-center">
                                <!-- Form untuk Mengurangi Jumlah Barang -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ max($item->quantity - 1, 1) }}">
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        -
                                    </button>
                                </form>
                                
                                <!-- Teks input yang menampilkan jumlah barang yang ada -->
                                <input type="text" value="{{ $item->quantity }}" class="mx-2 w-12 text-center border rounded" readonly>
                                
                                <!-- Form untuk Menambah Jumlah Barang -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                        +
                                    </button>
                                </form>
                            </div>
                        </td>
                        <!-- Total harga per item berdasarkan jumlah yang dibeli -->
                        <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <!-- Baris untuk Menampilkan Total Keseluruhan Harga -->
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Total Keseluruhan</td>
                    
                    <!-- Menampilkan Total Keseluruhan Harga yang sudah dihitung dari seluruh item di keranjang -->
                    <td class="border border-gray-300 px-4 py-2 text-center font-bold">
                        Rp{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right"></td>
                    <!-- Tombol untuk Melanjutkan ke Halaman Checkout -->
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <!-- Tombol Checkout untuk Melanjutkan Pembelian -->
                            <button class="bg-primary text-white py-2 px-4 rounded hover:bg-teal-600">Checkout</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</x-layout>