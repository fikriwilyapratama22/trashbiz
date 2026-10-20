<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6">Data Setoran</h1>
    
        <div class="mb-4">
            <!-- Tombol untuk menambah setoran, mengarahkan ke halaman form tambah setoran -->
            <a href="{{ route('setoran.create') }}" 
                class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700"> 
                Tambah Setoran
            </a>
            <!-- Tombol untuk mencetak laporan, mengarahkan ke route laporan PDF -->
            <a href="{{ route('laporan.sampah.pdf') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-blue-700"> 
                Cetak Laporan
            </a>
        </div>

        <!-- Loop untuk menampilkan data setoran per nasabah -->
        @foreach($setorans as $nasabah => $setoransPerNasabah)
            <!-- Menampilkan nama nasabah (sebagai header untuk setiap grup setoran) -->
            <h2 class="font-bold text-xl text-gray-800 mb-4">{{ $nasabah }}</h2>

            <!-- Table untuk menampilkan data setoran per nasabah -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-hijau text-white">
                        <!-- Header tabel dengan kolom-kolom yang menampilkan informasi tentang setoran -->
                        <tr>
                            <th class="px-4 py-2 border-b">No</th>
                            <th class="px-4 py-2 border-b">Sampah</th>
                            <th class="px-4 py-2 border-b">Tanggal</th>
                            <th class="px-4 py-2 border-b">Setoran/Kg</th>
                            <th class="px-4 py-2 border-b">Setoran</th>
                            <th class="px-4 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan setiap data setoran yang terkait dengan nasabah -->
                        @foreach($setoransPerNasabah as $dataSetoran)
                            <tr>
                                <td class="px-4 py-2 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b text-center">{{ $dataSetoran->sampah ? $dataSetoran->sampah->jenis : 'Jenis tidak tersedia' }}</td>
                                <td class="px-4 py-2 border-b text-center">{{ $dataSetoran->tanggal }}</td>
                                <td class="px-4 py-2 border-b text-center">{{ $dataSetoran->setor }}</td>
                                <td class="px-4 py-2 border-b text-center">{{ $dataSetoran->jumlah_setoran }}</td>
                                <td class="px-4 py-2 border-b text-center">
                                    <a href="{{ route('setoran.update', $dataSetoran->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                    <!-- Form untuk menghapus data setoran -->
                                    <form action="{{ route('setoran.destroy', $dataSetoran->id) }}" method="POST" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <!-- Tombol untuk menghapus data setoran, dengan konfirmasi sebelum penghapusan -->
                                        <button type="submit" class="text-red-500 hover:underline" 
                                            onclick="return confirm('Yakin akan menghapus data?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</x-layout>
