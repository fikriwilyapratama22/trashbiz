<x-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Data Nasabah</h1>

        <!-- Tombol Aksi -->
        <div class="mb-4">
            <a href="{{ route('nasabah.create') }}" 
                class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                Tambah Nasabah
            </a>
        </div>
          
        <!-- Tabel Data Nasabah -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">No. Induk</th>
                        <th class="px-4 py-2 border-b">Nama </th>
                        <th class="px-4 py-2 border-b">Alamat</th>
                        <th class="px-4 py-2 border-b">Jumlah Orang/KK </th>
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white" id="nasabahTableBody">
                    @foreach($nasabahs as $dataNasabah)
                    <tr>
                        <td class="px-4 py-2 border-b text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $dataNasabah->no_induk }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $dataNasabah->nama }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $dataNasabah->alamat }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $dataNasabah->jumlah_orang_kk }}</td>
                        <td class="px-4 py-2 border-b text-center">
                            <!-- Tombol Edit dan Hapus -->
                            <a href="{{ route('nasabah.update', $dataNasabah->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('nasabah.destroy', $dataNasabah->id) }}" method="POST" class="inline-block">
                                @method('DELETE')
                                @csrf
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
    </div>
</x-layout>
