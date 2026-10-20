<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <!-- Judul modal -->
                    <h3 class="text-2xl leading-6 font-bold text-primary">Detail Setoran</h3>
                    <!-- Tombol tutup modal, mengarah ke halaman riwayat setoran -->
                    <button class="text-gray-400 hover:text-gray-500">
                        <a href="{{ route('riwayat.setoran') }}" class="material-icons">close</a>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- Menampilkan tanggal setoran -->
                    <p><strong>Tanggal :</strong> {{ $dataSetoran->tanggal }}</p>
                    <!-- Menampilkan nama nasabah yang melakukan setoran -->
                    <p><strong>Nasabah :</strong> {{ $dataSetoran->nasabah->nama }}</p>

                    <!-- Menampilkan rincian jenis sampah dan berat setoran -->
                    <div class="mt-4">
                        <strong>Rincian Jenis Sampah dan Berat Setoran :</strong>
                        <ul>
                            <!-- Mengiterasi setiap data setoran yang dikelompokkan berdasarkan tanggal -->
                            @foreach($groupedSetorans as $setoranTanggal => $setorans)
                                @foreach($setorans as $setoran)
                                    <li>
                                        <!-- Menampilkan jenis sampah dan beratnya -->
                                        <p><strong>*</strong> {{ $setoran->sampah->jenis }} = {{ $setoran->setor }} Kg</p>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>

                    <!-- Menampilkan total setoran dan total poin yang didapat -->
                    <div class="mt-4">
                        <p><strong>Total Setoran :</strong> Rp.{{ $dataSetoran->jumlah_setoran }}</p>
                        <p><strong>Total Poin :</strong> 
                            @php
                                // Menghitung total poin berdasarkan jumlah setoran
                                $totalPoin = $groupedSetorans->sum(function($setorans) {
                                    return $setorans->sum(function($setoran) {
                                        return floor($setoran->setor / 2); // 1 poin untuk setiap 2 Kg
                                    });
                                });
                            @endphp
                            <!-- Menampilkan total poin -->
                            {{ $totalPoin }} <!-- Total poin untuk semua setoran pada tanggal tersebut -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
