<x-layout>
    <div class="bg-primary text-white p-6 rounded-lg shadow-md">
        <!-- Judul Dashboard -->
        <h1 class="text-3xl font-bold">Dashboard Nasabah</h1>
        <!-- Pesan selamat datang dengan nama pengguna -->
        <p class="mt-2 text-lg">Selamat datang, {{ Auth::user()->nama }}!</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Tabel Data (Belum ada konten pada bagian ini) -->
        <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200 mb-4">
            <thead class="bg-hijau text-white">
            </thead>
            <tbody class="bg-white text-center">
                @php 
                    // Inisialisasi variabel untuk menghitung total
                    $counter = 1; 
                    $totalBerat = 0; 
                    $totalSetoran = 0; 
                    $totalPoin = 0; 
                @endphp
                <!-- Iterasi melalui data setoran untuk menghitung total berdasarkan nasabah yang sedang login -->
                @foreach($setorans as $index => $dataSetoran)
                    @if(Auth::user()->nama == $dataSetoran['nasabah'])
                        @php
                            // Menghitung poin dari setoran (setiap Rp 2 mendapatkan 1 poin)
                            $poin = floor($dataSetoran['jumlah_setoran'] / 2);
                            // Menambahkan total berat, total setoran, dan poin
                            $totalBerat += $dataSetoran['jumlah_setoran'];
                            $totalSetoran += $dataSetoran['total_setoran'];
                            $totalPoin += $poin;
                        @endphp
                    @endif
                @endforeach
                @php
                    // Menghitung saldo akhir (Setoran - Penarikan)
                    $saldoAkhir = $totalSetoran - $totalPenarikan;
                @endphp
            </tbody>
        </table>

        <!-- Grid untuk menampilkan informasi total berat, saldo, dan poin -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Berat Setoran -->
            <div class="bg-gradient-to-r from-green-200 to-blue-200 p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
                <p class="text-lg font-bold text-slate-700 mb-2">Total Berat Setoran (Kg):</p>
                <p class="text-4xl font-bold">{{ number_format($totalBerat, 0, ',', '.') }} Kg</p>
            </div>
    
            <!-- Total Saldo (Setoran - Penarikan) -->
            <div class="bg-gradient-to-r from-green-200 to-blue-200 p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
                <a href="{{ route('riwayat.setoranNasabah') }}" class="block">
                <p class="text-lg font-bold text-slate-700 mb-2">Saldo:</p>
                <p class="text-4xl font-bold">Rp.{{ number_format($saldoAkhir, 0, ',', '.') }}</p>
            </div>
    
            <!-- Total Poin (Poin dihitung berdasarkan setoran) -->
            <div class="bg-gradient-to-r from-green-200 to-blue-200 p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
                <p class="text-lg font-bold text-slate-700 mb-2">Total Poin:</p>
                <p class="text-4xl font-bold">{{ $totalPoin }} Poin</p>
            </div>
        </div>
    </div>

    <!-- Daftar Pesanan Nasabah -->
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-left">Daftar Pesanan</h1>
    
        <!-- Menampilkan pesan jika belum ada pesanan -->
        @if($penjualan->isEmpty())
            <p class="text-center text-gray-500 mt-4">Belum ada pembelian barang yang dilakukan.</p>
        @else
            <!-- Tabel Daftar Pesanan -->
            <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">Tanggal Pembelian</th>
                        <th class="py-2 px-4 border-b text-center">Produk</th>
                        <th class="py-2 px-4 border-b text-center">Harga</th>
                        <th class="py-2 px-4 border-b text-center">Jumlah Barang</th>
                        <th class="py-2 px-4 border-b text-center">Total</th>
                        <th class="py-2 px-4 border-b text-center">Metode Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iterasi melalui pesanan untuk menampilkan detail pesanan -->
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
