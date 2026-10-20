<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6">Permintaan Penarikan</h1>

        <!-- Table untuk menampilkan data penarikan -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <!-- Header tabel -->
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">Tanggal</th>
                        <th class="px-4 py-2 border-b">Nama Nasabah</th>
                        <th class="px-4 py-2 border-b">Jumlah Penarikan</th>
                        <th class="px-4 py-2 border-b">Status</th>
                    </tr>
                </thead>

                <!-- Body tabel yang berisi data penarikan -->
                <tbody>
                    @forelse($penarikans as $index => $penarikan)
                        <tr>
                            <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ \Carbon\Carbon::parse($penarikan->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border-b text-center">{{ $penarikan->user->nama ?? 'Nasabah Tidak Ditemukan' }}</td>
                            <td class="px-4 py-2 border-b text-center">Rp.{{ number_format($penarikan->jumlah, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b text-center flex justify-center">
                                @if ($penarikan->status !== 'Diterima' && $penarikan->status !== 'Ditolak')
                                    <form action="{{ route('penarikan.update-status', $penarikan->id) }}" method="POST" class="text-pribg-primary hover:text-pribg-primary mr-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Diterima">
                                        <button type="submit" class="px-4 py-2 rounded-lg bg-green-500 hover:bg-green-700 text-white">
                                            Disetujui
                                        </button>
                                    </form>
                                    <!-- Tombol Ditolak (aktif jika status belum Diterima atau Ditolak) -->
                                    <form action="{{ route('penarikan.update-status', $penarikan->id) }}" method="POST" class="text-pribg-primary hover:text-pribg-primary mr-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-700 text-white">
                                            Ditolak
                                        </button>
                                    </form>
                                @else
                                    <!-- Jika status sudah Diterima, tampilkan tombol yang dinonaktifkan -->
                                    @if ($penarikan->status === 'Diterima')
                                        <form action="#" method="POST" class="text-pribg-primary hover:text-pribg-primary mr-2">
                                            @csrf
                                            <button type="button" class="px-4 py-2 rounded-lg bg-gray-400 cursor-not-allowed" disabled>
                                                Disetujui
                                            </button>
                                        </form>
                                    @endif
                                    <!-- Jika status sudah Ditolak, tampilkan tombol yang dinonaktifkan -->
                                    @if ($penarikan->status === 'Ditolak')
                                        <form action="#" method="POST" class="text-pribg-primary hover:text-pribg-primary mr-2">
                                            @csrf
                                            <button type="button" class="px-4 py-2 rounded-lg bg-gray-400 cursor-not-allowed" disabled>
                                                Ditolak
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>   
                        </tr>
                    @empty
                    <!-- Jika tidak ada data penarikan, tampilkan pesan -->
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data penarikan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
