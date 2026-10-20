<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Judul halaman Riwayat Setoran -->
        <h1 class="text-3xl font-bold mb-6">Riwayat Setoran</h1>

        <!-- Tabel untuk menampilkan riwayat setoran -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <!-- Header tabel -->
                <thead class="bg-hijau text-white">
                    <tr>
                        <!-- Kolom No -->
                        <th class="px-4 py-2 border-b">No</th>
                        <!-- Kolom Tanggal -->
                        <th class="px-4 py-2 border-b">Tanggal</th>
                        <!-- Kolom Nasabah -->
                        <th class="px-4 py-2 border-b">Nasabah</th>
                        <!-- Kolom Jumlah Setoran (Kg) -->
                        <th class="px-4 py-2 border-b">Jumlah Setoran (Kg)</th>
                        <!-- Kolom Total Setoran -->
                        <th class="px-4 py-2 border-b">Total Setoran</th>
                        <!-- Kolom Poin -->
                        <th class="px-4 py-2 border-b">Poin</th>
                        <!-- Kolom Aksi -->
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iterasi untuk setiap data setoran -->
                    @foreach($setorans as $index => $dataSetoran)
                        @php
                            // Menghitung poin berdasarkan jumlah setoran (1 poin per 2 Kg)
                            $poin = floor($dataSetoran['jumlah_setoran'] / 2);
                        @endphp
                        <tr>
                            <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $dataSetoran['tanggal'] }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $dataSetoran['nasabah'] }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $dataSetoran['jumlah_setoran'] }} Kg</td>
                            <td class="px-4 py-2 border-b text-center">{{ $dataSetoran['total_setoran'] }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $poin }}</td>
                            <!-- Aksi: link ke detail setoran -->
                            <td class="px-4 py-2 border-b text-center">
                                <a href="{{ route('setoran-detail', $dataSetoran['id']) }}" class="text-blue-600 hover:underline">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>                      
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
