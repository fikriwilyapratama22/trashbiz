<x-layout>
    <!-- Halaman Data User -->
    <div class="container mx-auto px-4 py-6">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6">Data User</h1>

        <!-- Tombol Aksi untuk Menambah User -->
        <div class="mb-4">
            <a href="{{ route('admin.create') }}" 
                class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                Tambah User
            </a>
        </div>

        <!-- Tabel Data Admin -->
        <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <!-- Header Tabel -->
            <thead class="bg-hijau text-white">
                <tr>
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Nama</th>
                    <th class="px-4 py-2 border-b">Alamat</th>
                    <th class="px-4 py-2 border-b">No.Hp(WA)</th>
                    <th class="px-4 py-2 border-b">Email</th>
                    <th class="px-4 py-2 border-b">Level</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterasi Melalui Data User (Admin) -->
                @foreach($users as $dataAdmin)
                <tr>
                    <!-- Menampilkan Nomor Urut -->
                    <td class="px-4 py-2 border-b text-center">{{ $loop->iteration }}</td>
                    <!-- Menampilkan Nama Admin -->
                    <td class="px-4 py-2 border-b text-center">{{ $dataAdmin->nama }}</td>
                    <!-- Menampilkan Alamat Admin -->
                    <td class="px-4 py-2 border-b text-center">{{ $dataAdmin->alamat }}</td>
                    <!-- Menampilkan No. HP WA Admin -->
                    <td class="px-4 py-2 border-b text-center">{{ $dataAdmin->no_hp_wa }}</td>
                    <!-- Menampilkan Email Admin -->
                    <td class="px-4 py-2 border-b text-center">{{ $dataAdmin->email }}</td>
                    <!-- Menampilkan Level Admin -->
                    <td class="px-4 py-2 border-b text-center">{{ $dataAdmin->level }}</td>
                    <!-- Menampilkan Tindakan Aksi: Edit dan Hapus -->
                    <td class="px-4 py-2 border-b text-center">
                        <!-- Tautan untuk Edit Data Admin -->
                        <a href="{{ route('admin.update', $dataAdmin->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                        <!-- Form untuk Menghapus Data Admin -->
                        <form action="{{ route('admin.destroy', $dataAdmin->id) }}" method="POST" class="inline-block">
                            @method('DELETE')
                            @csrf
                            <!-- Tombol untuk Menghapus Data Admin dengan Konfirmasi -->
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
