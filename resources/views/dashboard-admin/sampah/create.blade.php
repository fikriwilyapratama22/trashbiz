<x-layout>
    <!-- Modal Container -->
    <div class="fixed z-50 inset-0">
        <!-- Flexbox Container to center the modal -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay for background dimming -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <!-- Modal Box -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <!-- Modal Header with Title and Close Button -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Sampah</h3>
                    <!-- Close Button -->
                    <button class="text-gray-400 hover:text-gray-500">
                        <a href="{{ route('sampah.index') }}" class="material-icons">close</a>
                    </button>
                </div>
                <!-- Form for Adding Sampah -->
                <form action="{{ route('sampah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <!-- Input for Gambar (Image) -->
                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <!-- File Input for image upload -->
                        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" accept="image/*" required>
                    </div>
                    <!-- Input for Jenis Sampah -->
                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                        <!-- Text Input for the type of waste -->
                        <input type="text" name="jenis" id="jenis" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    </div>
                    <!-- Input for Harga (Price) -->
                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <!-- Number Input for the price of the waste -->
                        <input type="number" name="harga" id="harga" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    </div>
                    <!-- Action Buttons (Cancel & Save) -->
                    <div class="flex justify-end">
                        <!-- Cancel Button (Redirects to Sampah Index) -->
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="window.location.href='{{ route('sampah.index') }}'">
                            Batal
                        </button>
                        <!-- Save Button (Submit the Form) -->
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
    