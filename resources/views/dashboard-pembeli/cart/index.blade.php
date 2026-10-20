<x-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center">Keranjang Belanja</h1>

        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <!-- Header tabel -->
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nama Produk</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Harga</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total</th>
                </tr>
            </thead>
            <!-- Body tabel untuk menampilkan rincian produk dalam keranjang belanja -->
            <tbody>
                @foreach ($cartItems as $index => $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->product_name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <!-- Kolom untuk memilih jumlah produk yang akan dibeli -->
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex justify-center items-center">
                                <!-- Form untuk mengurangi jumlah produk -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ max($item->quantity - 1, 1) }}">
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        -
                                    </button>
                                </form>
                                <!-- Menampilkan jumlah produk dalam input yang tidak dapat diedit -->
                                <input type="text" value="{{ $item->quantity }}" class="mx-2 w-12 text-center border rounded" readonly>
                                <!-- Form untuk menambah jumlah produk -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                        +
                                    </button>
                                </form>
                            </div>
                        </td>
                        <!-- Menampilkan total harga untuk item tersebut -->
                        <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <!-- Footer tabel untuk menampilkan total keseluruhan dan tombol checkout -->
            <tfoot>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Total Keseluruhan</td>
                    <td class="border border-gray-300 px-4 py-2 text-center font-bold">
                        Rp{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right"></td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <!-- Formulir untuk memulai checkout -->
                        <form action="{{ route('cart.create')}}">
                            @csrf
                            <button class="bg-primary text-white py-2 px-4 rounded hover:bg-teal-600">Checkout</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</x-layout>
