<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <!-- Header Modal -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Data Nasabah</h3>
                    <!-- Tombol untuk menutup modal dan kembali ke halaman daftar nasabah -->
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <a href="{{ route('nasabah.index') }}" class="material-icons">close</a>
                    </button>
                </div>
                <!-- Formulir input untuk mengedit data nasabah -->
                <form action="{{ route('nasabah.update', $dataNasabah->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <!-- Input untuk No Induk Nasabah -->
                    <div class="mb-4">
                        <label for="no_induk" class="block text-sm font-bold mb-2">No Induk</label>
                        <input type="text" name="no_induk" id="no_induk" value="{{ $dataNasabah->no_induk }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <!-- Input untuk Nama Nasabah -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-bold mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ $dataNasabah->nama }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <!-- Input untuk Alamat Nasabah -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-bold mb-2">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ $dataNasabah->alamat }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <!-- Input untuk Jumlah Orang/KK -->
                    <div class="mb-4">
                        <label for="jumlah_orang_kk" class="block text-sm font-bold mb-2">Jumlah Orang/KK</label>
                        <input type="text" name="jumlah_orang_kk" id="jumlah_orang_kk" value="{{ $dataNasabah->jumlah_orang_kk }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Tombol Aksi: Cancel dan Save -->
                    <div class="flex justify-end">
                        <!-- Tombol Cancel untuk membatalkan perubahan dan kembali ke daftar nasabah -->
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="window.location.href='{{ route('nasabah.index') }}'">
                            Cancel
                        </button>
                        <!-- Tombol Save untuk menyimpan perubahan data -->
                        <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
