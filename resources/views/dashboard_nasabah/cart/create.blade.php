<x-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center">Konfirmasi Pembelian</h1>

        <!-- Menampilkan notifikasi error jika ada -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cart.store')}}" method="POST">
            @csrf
            <!-- Tabel yang menampilkan rincian item dalam keranjang -->
            <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Nama Produk</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Harga</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Jumlah</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $index => $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->product_name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <input type="number" name="quantities[{{ $item->id }}]" value="{{ old('quantities.'.$item->id, $item->quantity) }}" 
                                    class="w-16 text-center border rounded" min="1" required>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-bold">Total Keseluruhan</td>
                        <td class="border border-gray-300 px-4 py-2 text-center font-bold">
                            Rp{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-6">
                <!-- Input untuk Nama Pembeli -->
                <div class="mb-4">
                    <label for="pembeli" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                    <input type="text" id="pembeli" name="pembeli" 
                           value="{{ old('pembeli', Auth::user()->nama) }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" readonly>
                </div>

                <!-- Input untuk Nomor Telepon WA -->
                <div class="mb-4">
                    <label for="no_telp" class="block text-sm font-medium text-gray-700">Nomor WA</label>
                    <input type="text" id="no_telp" name="no_telp" 
                           value="{{ old('no_telp', Auth::user()->no_hp_wa) }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                    @error('no_telp')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input untuk Alamat Pembeli -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat" 
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>{{ old('alamat', Auth::user()->alamat) }}</textarea>
                    @error('alamat')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input untuk memilih metode pembayaran -->
                <div class="mb-4">
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" required>
                        <option value="cod" {{ old('metode_pembayaran') === 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                        <option value="transfer" {{ old('metode_pembayaran') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                    @error('metode_pembayaran')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded hover:bg-teal-600">Selesaikan Pembelian</button>
            </div>
        </form>
    </div>
</x-layout>
