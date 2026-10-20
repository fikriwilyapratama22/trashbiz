<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah User</h3>
                    <!-- Tombol untuk menutup modal dan kembali ke halaman daftar user -->
                    <button class="text-gray-400 hover:text-gray-500">
                        <a href="{{ route('admin.index') }}" class="material-icons">close</a>
                    </button>
                </div>
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <!-- Input untuk Nama User -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
    
                    <!-- Input untuk Alamat User -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
    
                    <!-- Input untuk Nomor HP/Wa User -->
                    <div class="mb-4">
                        <label for="noHp" class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                        <input type="text" name="no_hp_wa" id="noHp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
    
                    <!-- Input untuk Email User -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
    
                    <!-- Input untuk Password User -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
    
                    <!-- Dropdown untuk memilih Level User -->
                    <div class="mb-4">
                        <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                        <select name="level" id="level"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm">
                            <option value="Nasabah">Nasabah</option>
                            <option value="Pembeli">Pembeli</option>
                        </select>
                    </div>
    
                    <!-- Tombol Aksi: Cancel dan Save -->
                    <div class="flex justify-end">
                        <!-- Tombol Cancel untuk membatalkan dan kembali ke halaman daftar user -->
                        <button type="button"
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                                onclick="window.location.href='{{ route('admin.index') }}'">
                                Cancel
                            </button>
                        <!-- Tombol Save untuk menyimpan data yang baru diinput -->
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
    