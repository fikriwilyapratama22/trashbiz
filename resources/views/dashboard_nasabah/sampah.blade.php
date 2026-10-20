<x-layout>
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Data Sampah</h1>
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Looping untuk menampilkan setiap data sampah -->
            @foreach($sampahs as $dataSampah)
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <!-- Menampilkan gambar sampah -->
                    <div class="flex justify-center">
                        <img src="{{ asset('img/' . $dataSampah->gambar) }}" alt="{{ $dataSampah->jenis }}" class="max-w-xs h-48 object-contain rounded-t-lg">
                    </div>
                    <!-- Menampilkan nama jenis sampah dan harga per kilogram -->
                    <div class="text-center mt-4">
                        <h5 class="font-semibold text-lg">{{ $dataSampah->jenis }}</h5>
                        <p class="text-gray-600 mt-2">Rp {{ number_format($dataSampah->harga, 0) }} /Kg</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
