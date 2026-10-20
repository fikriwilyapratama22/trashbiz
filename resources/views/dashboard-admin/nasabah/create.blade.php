<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <!-- Header Modal -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Nasabah</h3>
                    <!-- Tombol untuk menutup modal dan kembali ke halaman daftar nasabah -->
                    <button class="text-gray-400 hover:text-gray-500">
                        <a href="{{ route('nasabah.index') }}" class="material-icons">close</a>
                    </button>
                </div>
                <!-- Formulir input untuk menambah data nasabah -->
                <form action="{{ route('nasabah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Input untuk No Induk Nasabah -->
                    <div class="mb-4">
                        <label for="noInduk" class="block text-sm font-medium text-gray-700">No Induk</label>
                        <input type="text" name="no_induk" id="noInduk" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <!-- Input untuk Nama Nasabah -->
                    <div class="mb-4">
                        <label for="namaNasabah" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="namaNasabah" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <!-- Input untuk Alamat Nasabah -->
                    <div class="mb-4">
                        <label for="alamatNasabah" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamatNasabah" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <!-- Input untuk Jumlah Orang/KK -->
                    <div class="mb-4">
                        <label for="jumlahKK" class="block text-sm font-medium text-gray-700">Jumlah Orang/KK</label>
                        <input type="text" name="jumlah_orang_kk" id="jumlahKK"  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <!-- Tombol Aksi: Batal dan Simpan -->
                    <div class="flex justify-end">
                        <!-- Tombol Batal untuk membatalkan input dan kembali ke halaman daftar nasabah -->
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="window.location.href='{{ route('nasabah.index') }}'">
                            Batal
                        </button>
                        <!-- Tombol Simpan untuk menyimpan data yang baru diinput -->
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
