<div style="width: 100%; overflow-x: auto;">
    <!-- Judul Neraca Saldo Bank Sampah Raznanqa -->
    <h1 style="text-align: center; font-size: 20px; margin-bottom: 10px; font-weight: bold;">
        Bank Sampah Raznanqa - Neraca Saldo
    </h1>
    
    <!-- Tabel untuk menampilkan laporan neraca saldo -->
    <table style="font-size: 12px; width: 100%; border-collapse: collapse; border: 1px solid #000;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 8px; text-align: center;">No.</th>
                <th style="border: 1px solid #000; padding: 8px; text-align: center;">Tanggal</th>
                <th colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center;">Kredit</th>
                <th colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center;">Debit</th>
                <th style="border: 1px solid #000; padding: 8px; text-align: center;">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <!-- Inisialisasi variabel untuk perhitungan total -->
            @php
                $saldo = 0;
                $totalKredit = 0;
                $totalDebit = 0;
                $totalPenarikan = 0;
                $totalSetor = 0;
                $totalBanyakBarang = 0;
            @endphp

            <!-- Iterasi untuk setiap item laporan -->
            @foreach ($laporan as $index => $item)
                <tr>
                    <!-- Nomor urut -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ $index + 1 }}</td>

                    <!-- Tanggal transaksi -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        {{-- Menampilkan tanggal setoran, penjualan, atau penarikan jika ada --}}
                        @if($item['tanggal_setoran'] || $item['tanggal_penjualan'] || $item['tanggal_penarikan'])
                            {{ \Carbon\Carbon::parse($item['tanggal_setoran'] ?: $item['tanggal_penjualan'] ?: $item['tanggal_penarikan'])->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <!-- Kolom Kredit -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        @if($item['tanggal_setoran'])
                            @if($item['setor'] > 0)
                                Setor sampah : {{ number_format($item['setor'], 0, ',', '.') }} Kg
                                @php $totalSetor += $item['setor']; @endphp
                            @else
                                -
                            @endif
                        @elseif($item['tanggal_penarikan'])
                            @if($item['kredit'] > 0)
                                Tarik saldo : Rp.{{ number_format($item['kredit'], 0, ',', '.') }}
                                @php $totalPenarikan += $item['kredit']; @endphp
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </td>

                    <!-- Menampilkan nilai Kredit -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        @php
                            $kredit = $item['kredit'] ?? 0; 
                            $totalKredit += $kredit; 
                        @endphp
                        @if($kredit > 0)
                            Rp. {{ number_format($kredit, 0, ',', '.') }} 
                        @else
                            -  
                        @endif
                    </td>

                    <!-- Kolom Debit -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        @php
                            $banyakBarang = $item['banyak_barang'] ?? 0; 
                            $totalBanyakBarang += $banyakBarang; 
                        @endphp
                        @if($banyakBarang > 0)
                            Penjualan : {{ $banyakBarang }} item  
                        @else
                            -  
                        @endif
                    </td>

                    <!-- Menampilkan nilai Debit -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        @php
                            $debit = $item['debit'] ?? 0; 
                            $totalDebit += $debit; 
                        @endphp
                        @if($debit > 0)
                            Rp. {{ number_format($debit, 0, ',', '.') }} 
                        @else
                            -  
                        @endif
                    </td>

                    <!-- Menampilkan saldo akhir -->
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                        @php
                            $saldo += $item['debit'] - $item['kredit'];
                        @endphp
                        Rp. {{ number_format($saldo, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <!-- Baris total untuk kredit, debit, dan saldo -->
            <tr>
                <td colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">Total</td>
                <td colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">Rp. {{ number_format($totalKredit, 0, ',', '.') }}</td>
                <td colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">Rp. {{ number_format($totalDebit, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; font-weight: bold;">
                    Rp. {{ number_format($saldo, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>
