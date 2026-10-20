<div>
    <!-- Judul laporan -->
    <h1 style="text-align: center; font-size: 19px; margin-bottom: 20px;">
        Laporan Setoran Bank Sampah Raznanqa
    </h1>

    <!-- Tabel laporan -->
    <table style="font-size: 12px; width: 100%; border-collapse: collapse; border: 1px solid #000;">
        <thead>
            <tr>
                <!-- Header pertama: No, Tanggal, Jenis Sampah -->
                <th rowspan="2" style="border: 1px solid #000; text-align: center;">No.</th>
                <th rowspan="2" style="border: 1px solid #000; text-align: center;">Tanggal</th>
                <th colspan="{{ count($sampahs) }}" style="border: 1px solid #000; text-align: center;">Jenis Sampah (KG)</th>
                <th rowspan="2" style="border: 1px solid #000; text-align: center;">Jumlah</th>
            </tr>
            <tr>
                <!-- Header kedua: Jenis sampah -->
                @foreach($sampahs as $dataSampah)
                    <th style="border: 1px solid #000; text-align: center;">{{ $dataSampah->jenis }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if(isset($setoransQuery) && is_iterable($setoransQuery))
                @php
                    $groupedSetorans = [];
                    $totalPerJenis = array_fill_keys(array_column($sampahs->toArray(), 'id'), 0);
                    $grandTotal = 0;

                    foreach ($setoransQuery as $dataSetoran) {
                        $tanggal = $dataSetoran['tanggal'];
                        if (!isset($groupedSetorans[$tanggal])) {
                            $groupedSetorans[$tanggal] = [
                                'tanggal' => $tanggal,
                                'total_setoran' => 0,
                                'detail_setoran' => []
                            ];
                        }
                        $groupedSetorans[$tanggal]['total_setoran'] += $dataSetoran['jumlah_setoran'];
                        $groupedSetorans[$tanggal]['detail_setoran'][] = $dataSetoran;

                        if (isset($totalPerJenis[$dataSetoran['jenis_sampah']])) {
                            $totalPerJenis[$dataSetoran['jenis_sampah']] += $dataSetoran['setor'];
                        }
                    }
                @endphp

                @foreach($groupedSetorans as $group)
                    <tr>
                        <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid #000; text-align: center;">
                            {{ \Carbon\Carbon::parse($group['tanggal'])->translatedFormat('d F Y') }}
                        </td>
                        @foreach($sampahs as $dataSampah)
                            @php
                                $setoranJenis = 0;
                                foreach ($group['detail_setoran'] as $detail) {
                                    if ($detail['jenis_sampah'] === $dataSampah->id) {
                                        $setoranJenis += $detail['setor'];
                                    }
                                }
                            @endphp
                            <td style="border: 1px solid #000; text-align: center;">
                                {{ $setoranJenis }}
                            </td>
                        @endforeach
                        <td style="border: 1px solid #000; text-align: center;">
                            Rp.{{ number_format($group['total_setoran'], 0, ',', '.') }}
                        </td>
                    </tr>
                    @php $grandTotal += $group['total_setoran']; @endphp
                @endforeach

                <tr>
                    <td colspan="2" style="border: 1px solid #000; text-align: center; font-weight: bold;">Total</td>
                    @foreach($sampahs as $dataSampah)
                        <td style="border: 1px solid #000; text-align: center; font-weight: bold;">
                            {{ $totalPerJenis[$dataSampah->id] }}
                        </td>
                    @endforeach
                    <td style="border: 1px solid #000; text-align: center; font-weight: bold;">
                        Rp.{{ number_format($grandTotal, 0, ',', '.') }}
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="{{ count($sampahs) + 3 }}" style="border: 1px solid #000; text-align: center;">
                        Tidak ada data setoran.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
