<x-layout>
    <!-- Konten Utama -->
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">
            Data Sampah
        </h1>
    </div>

    <!-- Overlay untuk Modal (Terlihat saat modal aktif) -->
    <div class="fixed z-10 inset-0 bg-gray-800 bg-opacity-50 backdrop-blur-sm hidden" id="overlay"></div>

    <!-- Kontainer untuk Tabel Data Sampah -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Tombol Aksi -->
        <div class="flex justify-between items-center mb-4">
            <!-- Tombol untuk Menambah Jenis Sampah -->
            <a href="{{ route('sampah.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700"> 
                Tambah Jenis Sampah
            </a>
        </div>

        <!-- Tabel Data Sampah -->
        <table class="table-fixed min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-hijau text-white">
                <tr>
                    <!-- Header Kolom Tabel -->
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        No
                    </th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Gambar
                    </th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Jenis Sampah
                    </th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Harga/Kg
                    </th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white" id="wasteTableBody">
                <!-- Loop untuk Menampilkan Data Sampah -->
                @foreach($sampahs as $dataSampah)
                <tr>
                    <!-- Menampilkan Nomor Urut -->
                    <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $loop->iteration }}</td>
                    <!-- Menampilkan Gambar Sampah -->
                    <td class="px-6 py-4 text-center border-2 border-gray-300">
                        <div class="flex justify-center">
                            <img src="{{ asset('img/' . $dataSampah->gambar) }}" alt="{{ $dataSampah->gambar }}" class="w-40 h-20 object-contain">
                        </div>
                    </td>
                    <!-- Menampilkan Jenis Sampah -->
                    <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $dataSampah->jenis }}</td>
                    <!-- Menampilkan Harga Sampah per Kg -->
                    <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $dataSampah->harga }}</td>
                    <!-- Aksi Edit dan Hapus -->
                    <td class="px-6 py-4 text-center border-2 border-gray-300">
                        <div class="inline-flex space-x-2">
                            <!-- Tombol Edit untuk Mengubah Data Sampah -->
                            <a href="{{ route('sampah.update', $dataSampah->id) }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 inline-flex items-center">
                                <span class="material-icons align-middle">edit</span>
                            </a>
                    
                            <!-- Tombol Hapus untuk Menghapus Data Sampah -->
                            <form action="{{ route('sampah.destroy', $dataSampah->id) }}" method="POST" class="inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 inline-flex items-center" 
                                    onclick="return confirm('Yakin akan menghapus data?')">
                                    <span class="material-icons align-middle">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</x-layout>
