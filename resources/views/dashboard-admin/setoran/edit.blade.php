<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <!-- Header Modal dengan judul dan tombol untuk menutup modal -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Data Admin</h3>
                    <!-- Tombol Close, mengarahkan pengguna kembali ke halaman daftar setoran -->
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <a href="{{ route('setoran.index') }}" class="material-icons">close</a>
                    </button>
                </div>

                <!-- Formulir untuk Mengedit Data Setoran -->
                <form action="{{ route('setoran.update', $dataSetoran->id) }}" method="POST" enctype="multipart/form-data">
                    <!-- Metode PUT digunakan untuk memperbarui data -->
                    @method('PUT')
                    @csrf
                    
                    <!-- Dropdown untuk memilih Nasabah -->
                    <div class="mb-4">
                        <label for="nama_nasabah" class="block text-sm font-bold mb-2">Nama Nasabah</label>
                        <select name="nama_nasabah" id="nama_nasabah" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <!-- Looping untuk menampilkan semua nama nasabah -->
                            @foreach ($nasabahs as $dataNasabah)
                                <!-- Menambahkan atribut 'selected' pada nasabah yang sudah dipilih -->
                                <option value="{{ $dataNasabah->id }}" {{ $dataNasabah->id == $dataSetoran->nasabah_id ? 'selected' : '' }}>
                                    {{ $dataNasabah->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Dropdown untuk memilih Jenis Sampah -->
                    <div class="mb-4">
                        <label for="jenis_sampah" class="block text-sm font-bold mb-2">Jenis Sampah</label>
                        <select name="jenis_sampah" id="jenis_sampah" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <!-- Looping untuk menampilkan jenis sampah -->
                            @foreach ($sampahs as $dataSampah)
                                <!-- Menambahkan atribut 'selected' pada jenis sampah yang dipilih -->
                                <option value="{{ $dataSampah->id }}" {{ $dataSampah->id == $dataSetoran->sampah_id ? 'selected' : '' }}>
                                    {{ $dataSampah->jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input untuk memasukkan Tanggal Setor -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-bold mb-2">Tanggal Setor</label>
                        <!-- Menampilkan tanggal yang sudah ada dari data yang dipilih -->
                        <input type="text" name="tanggal" id="tanggal" value="{{ $dataSetoran->tanggal }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>

                    <!-- Input untuk memasukkan jumlah Setoran dalam Kilogram -->
                    <div class="mb-4">
                        <label for="setor" class="block text-sm font-bold mb-2">Setoran/Kg</label>
                        <!-- Menampilkan jumlah setoran yang sudah ada dari data yang dipilih -->
                        <input type="text" name="setor" id="setor" value="{{ $dataSetoran->setor }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    
                    <div class="flex justify-end">
                        <!-- Tombol Cancel untuk membatalkan perubahan dan kembali ke halaman daftar setoran -->
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="window.location.href='{{ route('setoran.index') }}'">
                            Cancel
                        </button>
                        <!-- Tombol Save untuk menyimpan perubahan yang telah dilakukan -->
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