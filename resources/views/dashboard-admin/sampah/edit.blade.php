<x-layout>
    <!-- Modal Container -->
    <div class="fixed z-50 inset-0 overflow-y-auto">
        <!-- Flexbox untuk memusatkan modal di layar -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay latar belakang gelap untuk memberikan fokus pada modal -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <!-- Kontainer utama modal -->
            <div class="bg-white rounded-lg shadow-xl transform transition-all max-w-lg w-full overflow-hidden">
                <!-- Header modal dengan judul dan tombol tutup -->
                <div class="p-6 border-b border-gray-300 sticky top-0 bg-white z-10">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl leading-6 font-bold text-primary">Edit Data Sampah</h3>
                        <button class="text-gray-400 hover:text-gray-500">
                            <a href="{{ route('sampah.index') }}" class="material-icons">close</a>
                        </button>
                    </div>
                </div>
                <!-- Kontainer isi modal yang bisa di-scroll -->
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <form action="{{ route('sampah.update', $dataSampah->id) }}" method="POST" enctype="multipart/form-data" class="p-6 max-h-[70vh] overflow-y-auto">
                        @method('PUT')
                        @csrf
                        <!-- Input untuk mengganti gambar sampah -->
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-bold mb-2">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            @if($dataSampah->gambar)
                                <img src="{{ asset('img/' . $dataSampah->gambar) }}" alt="Current Image" class="mt-2 w-32">
                            @endif
                        </div>
                        <!-- Input untuk mengubah jenis sampah -->
                        <div class="mb-4">
                            <label for="jenis" class="block text-sm font-bold mb-2">Jenis Sampah</label>
                            <input type="text" name="jenis" id="jenis" value="{{ $dataSampah->jenis }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                        </div>
                        <!-- Input untuk mengubah harga sampah -->
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-bold mb-2">Harga</label>
                            <input type="number" name="harga" id="harga" value="{{ $dataSampah->harga }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                        </div>
                        <!-- Tombol Batal untuk kembali ke halaman daftar sampah -->
                        <button type="button"
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                                onclick="window.location.href='{{ route('sampah.index') }}'">
                                Batal
                        </button>
                        <!-- Tombol Simpan untuk menyimpan perubahan yang dilakukan -->
                        <button type="submit" class="mt-4 bg-hijau text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
