<x-layout>
    <div class="fixed z-50 inset-0">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Detail Setoran</h3>
                    <!-- Close Button -->
                    <button class="text-gray-400 hover:text-gray-500">
                        <a href="{{ route('riwayat.setoranNasabah') }}" class="material-icons">close</a>
                    </button>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- Tanggal Setoran -->
                    <p><strong>Tanggal :</strong> {{ $dataSetoran->tanggal }}</p>
                    <!-- Nama Nasabah -->
                    <p><strong>Nama Nasabah :</strong> {{ $dataSetoran->nasabah->nama }}</p>

                    <!-- Rincian Jenis Sampah dan Berat Setoran -->
                    <div class="mt-4">
                        <strong>Rincian Jenis Sampah dan Berat Setoran :</strong>
                        <ul>
                            @foreach($groupedSetorans as $setoranTanggal => $setorans)
                                @foreach($setorans as $setoran)
                                    <li>
                                        <!-- Menampilkan jenis sampah dan berat setoran -->
                                        <p><strong>*</strong> {{ $setoran->sampah->jenis }} = {{ $setoran->setor }} Kg</p>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>

                    <!-- Total Setoran dan Total Poin -->
                    <div class="mt-4">
                        <p><strong>Total Setoran :</strong> Rp.{{ $dataSetoran->jumlah_setoran }}</p>
                        <p><strong>Total Poin :</strong> 
                            @php
                                $totalPoin = $groupedSetorans->sum(function($setorans) {
                                    return $setorans->sum(function($setoran) {
                                        return floor($setoran->setor / 2);
                                    });
                                });
                            @endphp
                            {{ $totalPoin }} <!-- Menampilkan total poin berdasarkan setoran -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
