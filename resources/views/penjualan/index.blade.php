<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6">Daftar Pesanan</h1>

        <!-- Loop untuk menampilkan data penjualan per pembeli dan tanggal -->
        @foreach ($penjualanGrouped as $key => $group)
            <!-- Menampilkan nama pembeli dan tanggal (sebagai header untuk setiap grup) -->
            <h2 class="font-bold text-xl text-gray-800 mb-2">
                {{ explode('|', $key)[0] }} - {{ explode('|', $key)[1] }}
            </h2>

            <!-- Tabel untuk menampilkan data pesanan per pembeli dan tanggal -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-hijau text-white">
                        <tr>
                            <!-- Kolom Header -->
                            <th class="px-4 py-2 border-b text-center">No</th>
                            <th class="px-4 py-2 border-b text-center">Produk</th>
                            <th class="px-4 py-2 border-b text-center">Harga</th>
                            <th class="px-4 py-2 border-b text-center">Jumlah Barang</th>
                            <th class="px-4 py-2 border-b text-center">Total</th>
                            <th class="px-4 py-2 border-b text-center">Metode Pembayaran</th>
                            <th class="px-4 py-2 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Variabel untuk menghitung nomor urut dalam grup -->
                        @php
                            $groupIndex = 1;
                            $oldProduct = null;
                            $oldMetodePembayaran = null;
                            $totalJumlahBarang = 0;
                            $totalHarga = 0;
                        @endphp

                        <!-- Loop untuk menampilkan setiap pesanan dalam kelompok -->
                        @foreach ($group as $item)
                            @if ($oldProduct !== $item->produk || $oldMetodePembayaran !== $item->metode_pembayaran)
                                <!-- Jika produk atau metode pembayaran berubah, tampilkan baris baru -->
                                @if ($oldProduct !== null)
                                    <!-- Tampilkan baris sebelumnya jika ada -->
                                    <tr>
                                        <td class="px-4 py-2 border-b text-center">{{ $groupIndex }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ $oldProduct }}</td>
                                        <td class="px-4 py-2 border-b text-center">Rp.{{ number_format($oldPrice, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ $totalJumlahBarang }}</td>
                                        <td class="px-4 py-2 border-b text-center">Rp.{{ number_format($totalHarga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ ucfirst($oldMetodePembayaran) }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <a href="{{ route('penjualan.edit', $oldId) }}" class="text-blue-500 hover:underline">Edit</a> |
                                            <form action="{{ route('penjualan.destroy', $oldId) }}" method="POST" class="inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                                            </form>
                                            <div class="mt-2 text-center">
                                                <a href="https://wa.me/{{ $oldNoTelp }}?text=Halo%20{{ urlencode($oldPembeli) }}%2C%20ini%20resi%20pesanan%20Anda%20:%29%0A%0AProduk%20yang%20anda%20pesan%20adalah%20{{ urlencode($oldProduct) }}%2C%0Adengan%20harga%20%3A%20Rp.{{ number_format($oldPrice, 0, ',', '.') }}%20sebanyak%20{{ $totalJumlahBarang }}%20pcs%0ATotal%20Harga%20yang%20harus%20dibayarkan%20%3A%20Rp.{{ number_format($totalHarga, 0, ',', '.') }}%0AMetode%20Pembayaran%20%3A%20{{ ucfirst($oldMetodePembayaran) }}%0ATerima%20kasih%20telah%20berbelanja%21" target="_blank" class="text-green-500 hover:text-green-700">Kirim Resi</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $groupIndex++;
                                    @endphp
                                @endif

                                @php
                                    // Reset variabel untuk item yang baru
                                    $oldProduct = $item->produk;
                                    $oldMetodePembayaran = $item->metode_pembayaran;
                                    $oldPrice = $item->price;
                                    $oldId = $item->id;
                                    $oldNoTelp = $item->no_telp;
                                    $oldPembeli = $item->pembeli;
                                    $totalJumlahBarang = $item->banyak_barang;
                                    $totalHarga = $item->price * $item->banyak_barang;
                                @endphp
                            @else
                                <!-- Jika produk dan metode pembayaran sama, jumlahkan jumlah barang dan total -->
                                @php
                                    $totalJumlahBarang += $item->banyak_barang;
                                    $totalHarga += $item->price * $item->banyak_barang;
                                @endphp
                            @endif
                        @endforeach

                        <!-- Tampilkan baris terakhir setelah loop selesai -->
                        <tr>
                            <td class="px-4 py-2 border-b text-center">{{ $groupIndex }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $oldProduct }}</td>
                            <td class="px-4 py-2 border-b text-center">Rp.{{ number_format($oldPrice, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $totalJumlahBarang }}</td>
                            <td class="px-4 py-2 border-b text-center">Rp.{{ number_format($totalHarga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ ucfirst($oldMetodePembayaran) }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('penjualan.edit', $oldId) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <form action="{{ route('penjualan.destroy', $oldId) }}" method="POST" class="inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                                </form>
                                <div class="mt-2 text-center">
                                    <a href="https://wa.me/{{ $oldNoTelp }}?text=Halo%20{{ urlencode($oldPembeli) }}%2C%20ini%20resi%20pesanan%20Anda%20:%29%0A%0AProduk%20yang%20anda%20pesan%20adalah%20{{ urlencode($oldProduct) }}%2C%0Adengan%20harga%20%3A%20Rp.{{ number_format($oldPrice, 0, ',', '.') }}%20sebanyak%20{{ $totalJumlahBarang }}%20pcs%0ATotal%20Harga%20yang%20harus%20dibayarkan%20%3A%20Rp.{{ number_format($totalHarga, 0, ',', '.') }}%0AMetode%20Pembayaran%20%3A%20{{ ucfirst($oldMetodePembayaran) }}%0ATerima%20kasih%20telah%20berbelanja%21" target="_blank" class="text-green-500 hover:text-green-700">Kirim Resi</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</x-layout>
