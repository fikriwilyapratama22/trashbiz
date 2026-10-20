<x-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Bagian header dengan latar belakang utama -->
        <div class="bg-primary text-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold">Produk Daur Ulang Bank Sampah</h1>
            <p class="mt-2 text-lg">Silahkan beli barang yang anda perlukan!</p>
        </div>
    
        <!-- Bagian Produk Pembelian -->
        <section id="Pembelian" class="scroll-mt-24 bg-gray-100 py-10">
            <div class="container mx-auto text-center">
                <div class="flex flex-wrap justify-center gap-8">
                    <!-- Produk 1: Minyak Lampu dari Plastik -->
                    <div class="max-w-sm bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-center mt-4">
                            <!-- Gambar produk -->
                            <img src="{{ asset('images/minyak.jpg') }}" alt="Produk 1" class="max-w-xs h-48 object-contain rounded-t-lg">
                        </div>
                        <div class="p-4">
                            <!-- Nama produk -->
                            <h3 class="text-lg font-bold">Minyak Lampu dari Plastik</h3>
                            <p class="text-gray-700 mt-2">Minyak yang berbahan dasar plastik untuk lampu</p>
                            <p class="text-lg font-bold mt-4">Rp.10.000/liter</p>
                            
                            <div class="flex mt-4">
                                <!-- Tombol Beli Sekarang -->
                                <a href="{{ route('pembelian.create', ['produk' => 'Minyak Lampu dari Plastik', 'price' => 10000]) }}"
                                    class="flex-1 bg-primary text-white font-bold text-center py-2 rounded hover:bg-teal-600">
                                    Beli Sekarang
                                </a>
                                <!-- Tombol Keranjang -->
                                <a href="{{ route('cart.index', ['product_name' => 'Minyak Lampu dari Plastik', 'price' => 10000]) }}"
                                    class="flex items-center justify-center w-12 h-12 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2">
                                    <i class="fas fa-shopping-cart text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produk 2: Tas dari limbah Plastik -->
                    <div class="max-w-sm bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-center mt-4">
                            <!-- Gambar produk -->
                            <img src="{{ asset('images/tas.jpg') }}" alt="Tas dari limbah Plastik" class="max-w-xs h-48 object-contain rounded-t-lg">
                        </div>
                        <div class="p-4">
                            <!-- Nama produk -->
                            <h3 class="text-lg font-bold">Tas dari limbah Plastik</h3>
                            <p class="text-gray-700 mt-2">Kerajinan tas yang dibuat dari plastik</p>
                            <p class="text-lg font-bold mt-4">Rp.30.000/pcs</p>
                            
                            <div class="flex mt-4">
                                <!-- Tombol Beli Sekarang -->
                                <a href="{{ route('pembelian.create', ['produk' => 'Tas dari limbah Plastik', 'price' => 30000]) }}"
                                    class="flex-1 bg-primary text-white font-bold text-center py-2 rounded hover:bg-teal-600">
                                    Beli Sekarang
                                </a>
                                <!-- Tombol Keranjang -->
                                <a href="{{ route('cart.index', ['product_name' => 'Tas dari limbah Plastik', 'price' => 30000]) }}"
                                    class="flex items-center justify-center w-12 h-12 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2">
                                    <i class="fas fa-shopping-cart text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>                    
                    
                    <!-- Produk 3: Kerajinan dari kardus -->
                    <div class="max-w-sm bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex justify-center mt-4">
                            <!-- Gambar produk -->
                            <img src="{{ asset('images/kerajinan.jpeg') }}" alt="Kerajinan dari kardus" class="max-w-xs h-48 object-contain rounded-t-lg">
                        </div>
                        <div class="p-4">
                            <!-- Nama produk -->
                            <h3 class="text-lg font-bold">Kerajinan dari kardus</h3>
                            <p class="text-gray-700 mt-2">Kerajinan sebagai fasilitas untuk belajar Alfabet</p>
                            <p class="text-lg font-bold mt-4">Rp 15.000</p>
                            
                            <div class="flex mt-4">
                                <!-- Tombol Beli Sekarang -->
                                <a href="{{ route('pembelian.create', ['produk' => 'Kerajinan dari kardus', 'price' => 15000]) }}"
                                    class="flex-1 bg-primary text-white font-bold text-center py-2 rounded hover:bg-teal-600">
                                    Beli Sekarang
                                </a>
                                <!-- Tombol Keranjang -->
                                <a href="{{ route('cart.index', ['product_name' => 'Kerajinan dari kardus', 'price' => 15000]) }}"
                                    class="flex items-center justify-center w-12 h-12 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2">
                                    <i class="fas fa-shopping-cart text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
</x-layout>
