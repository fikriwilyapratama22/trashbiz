<x-layout>
    <!-- Bagian header yang menyambut pengguna -->
    <div class="bg-primary text-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold">Selamat datang, {{ Auth::user()->nama }}!</h1>
        <p class="mt-2 text-lg">Ini Riwayat Pembelian Barang Kamu :)</p>
    </div>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-left">Daftar Pesanan</h1>

        <!-- Kondisi jika belum ada riwayat pembelian -->
        @if($penjualan->isEmpty())
            <p class="text-center text-gray-500 mt-4">Belum ada pembelian barang yang dilakukan.</p>
        @else
            <!-- Tabel yang menampilkan riwayat pembelian -->
            <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <!-- Kolom-kolom tabel -->
                        <th class="py-2 px-4 border-b text-center">Tanggal Pembelian</th>
                        <th class="py-2 px-4 border-b text-center">Produk</th>
                        <th class="py-2 px-4 border-b text-center">Harga</th>
                        <th class="py-2 px-4 border-b text-center">Jumlah Barang</th>
                        <th class="py-2 px-4 border-b text-center">Total</th>
                        <th class="py-2 px-4 border-b text-center">Metode Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Menampilkan setiap riwayat pembelian -->
                    @foreach ($penjualan as $item)
                    <tr class="border-t">
                        <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $item->produk }}</td>
                        <td class="py-2 px-4 border-b text-center">Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $item->banyak_barang }}</td>
                        <td class="py-2 px-4 border-b text-center">Rp.{{ number_format($item->price * $item->banyak_barang, 0, ',', '.') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ ucfirst($item->metode_pembayaran) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>
