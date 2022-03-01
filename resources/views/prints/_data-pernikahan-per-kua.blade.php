<section class="sheet padding-10mm">
    <!-- Write HTML just like a web page -->
    <article class="text-xs font-bold text-center uppercase">Data Peristiwa Nikah Rujuk</article>
    <article class="text-xs font-bold text-center uppercase">Kementerian Agama Islam Kabupaten Mamuju</article>
    <article class="text-xs font-bold text-center uppercase">Tahun {{ $currentYear }}</article>

    @if ($pernikahanLuarBalaiAcc_count < $pernikahanLuarBalai_count)
        <p class="text-sm text-red-500"><span class="font-semibold">**Catatan!</span> Data pernikahan belum di ACC semua.</p>
    @endif
    <div class="flex">

        <div class="flex flex-col">
            <div class="text-xs mt-2">Bulan : {{ $bulan }}</div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-1" rowspan="3">No</th>
                        <th class="px-3 py-1" rowspan="3">Kecamatan</th>
                        <th class="px-3 py-1" rowspan="3">Luar Kantor</th>
                        <th class="px-3 py-1 text-center" colspan="4">Bebas Biaya</th>
                        <th class="px-3 py-1" rowspan="3">Jml NR</th>
                        <th class="px-3 py-1" rowspan="3">Total PNBP</th>
                        <th class="px-3 py-1 text-center" colspan="6">Berdasarkan Usia</th>
                    </tr>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-1" rowspan="2">Kantor</th>
                        <th class="px-3 py-1" rowspan="2">Miskin</th>
                        <th class="px-3 py-1" rowspan="2">Bencana Alam</th>
                        <th class="px-3 py-1" rowspan="2">Isbat</th>

                        <th class="px-3 py-1" colspan="2">Di Bawah 19 Thn</th>
                        <th class="px-3 py-1" colspan="2">19 s.d 21 Thn</th>
                        <th class="px-3 py-1" colspan="2">Di Atas 21 Thn</th>
                    </tr>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-1">Pria</th>
                        <th class="px-3 py-1">Wanita</th>

                        <th class="px-3 py-1">Pria</th>
                        <th class="px-3 py-1">Wanita</th>

                        <th class="px-3 py-1">Pria</th>
                        <th class="px-3 py-1">Wanita</th>

                    </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-center text-xs font-semibold">
                        <td>a</td>
                        <td>b</td>
                        <td>c</td>
                        <td>d</td>
                        <td>e</td>
                        <td>f</td>
                        <td>g</td>
                        <td>h=(c+d+e+f+g)</td>
                        <td>i=(c*Rp.600.000.00)</td>
                        <td>j</td>
                        <td>k</td>
                        <td>l</td>
                        <td>m</td>
                        <td>n</td>
                        <td>o</td>
                    </tr>
                    @php
                    $angkaAwal = 1;
                    $totJumlahNR = [];
                    $totJumlahPNBP = [];

                    $luarBalaiNikah = [];
                    $balaiNikah = [];
                    $kurangMampu = [];
                    $bencanaAlam = [];
                    $isbat = [];

                    $priaDibawah19Tahun = [];
                    $wanitaDibawah19Tahun = [];
                    $pria19Sampai21Tahun = [];
                    $wanita19Sampai21Tahun = [];
                    $priaDiatas21Tahun = [];
                    $wanitaDiatas21Tahun = [];
                    @endphp
                    @forelse ($kuas->unique('name') as $index => $kua)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 text-xs text-center">{{ $angkaAwal++ }}</td>
                        <td class="px-4 text-xs">{{ $kua->name }}</td>
                        {{-- Luar Kantor --}}
                        <td class="px-4 text-xs text-center">{{ $kua->luar_balai_nikah_count }}</td>
                        {{-- Kantor/Balai Nikah --}}
                        <td class="px-4 text-xs text-center">{{ $kua->balai_nikah_count }}</td>
                        {{-- Miskin --}}
                        <td class="px-4 text-xs text-center">{{ $kua->kurang_mampu_count }}</td>
                        {{-- Bencana Alam --}}
                        <td class="px-4 text-xs text-center">{{ $kua->bencana_alam_count }}</td>
                        {{-- Isbat --}}
                        <td class="px-4 text-xs text-center">{{ $kua->isbat_count }}</td>

                        {{-- Jumlah NR --}}
                        <td class="px-4 text-xs text-center">{{ $jumlahNR = $kua->luar_balai_nikah_count +
                            $kua->balai_nikah_count + $kua->kurang_mampu_count + $kua->bencana_alam_count +
                            $kua->isbat_count }}</td>

                        {{-- Total PNBP --}}
                        <td class="px-4 text-xs text-center">{{ number_format($jumlahPNBP =
                            $kua->luar_balai_nikah_count * 600000, 2) }}</td>

                        {{-- Di bawah 19 tahun --}}
                        {{-- Pria --}}
                        <td class="px-4 text-xs text-center">{{ $kua->pria_dibawah_19_tahun_count }}</td>
                        {{-- Wanita --}}
                        <td class="px-4 text-xs text-center">{{ $kua->wanita_dibawah_19_tahun_count }}</td>

                        {{-- 19-21 tahun --}}
                        {{-- Pria --}}
                        <td class="px-4 text-xs text-center">{{ $kua->pria_19_sampai_21_tahun_count }}</td>
                        {{-- Wanita --}}
                        <td class="px-4 text-xs text-center">{{ $kua->wanita_19_sampai_21_tahun_count }}</td>

                        {{-- Di atas 21 tahun --}}
                        {{-- Pria --}}
                        <td class="px-4 text-xs text-center">{{ $kua->pria_diatas_21_tahun_count }}</td>
                        {{-- Wanita --}}
                        <td class="px-4 text-xs text-center">{{ $kua->wanita_diatas_21_tahun_count }}</td>
                    </tr>

                    @php
                    $totJumlahNR[] .= $jumlahNR;
                    $totJumlahPNBP[] .= $jumlahPNBP;

                    $luarBalaiNikah[] .= $kua->luar_balai_nikah_count;
                    $balaiNikah[] .= $kua->balai_nikah_count;
                    $kurangMampu[] .= $kua->kurang_mampu_count;
                    $bencanaAlam[] .= $kua->bencana_alam_count;
                    $isbat[] .= $kua->isbat_count;

                    $priaDibawah19Tahun[] .= $kua->pria_dibawah_19_tahun_count;
                    $wanitaDibawah19Tahun[] .= $kua->wanita_dibawah_19_tahun_count;
                    $pria19Sampai21Tahun[] .= $kua->pria_19_sampai_21_tahun_count;
                    $wanita19Sampai21Tahun[] .= $kua->wanita_19_sampai_21_tahun_count;
                    $priaDiatas21Tahun[] .= $kua->pria_diatas_21_tahun_count;
                    $wanitaDiatas21Tahun[] .= $kua->wanita_diatas_21_tahun_count;
                    @endphp
                    @empty
                    <tr>
                        <td colspan="20" class="px-4 text-base font-bold justify-center text-center">Data
                            pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
                    </tr>
                    @endforelse
                    <tr class="text-center text-xs font-bold">
                        <td colspan="2">Jumlah</td>
                        <td>{{ array_sum($luarBalaiNikah) }}</td>
                        <td>{{ array_sum($balaiNikah) }}</td>
                        <td>{{ array_sum($kurangMampu) }}</td>
                        <td>{{ array_sum($bencanaAlam) }}</td>
                        <td>{{ array_sum($isbat) }}</td>

                        <td>{{ array_sum($totJumlahNR) }}</td>
                        <td>{{ number_format( array_sum($totJumlahPNBP), 2 ) }}</td>

                        <td>{{ array_sum($priaDibawah19Tahun) }}</td>
                        <td>{{ array_sum($wanitaDibawah19Tahun) }}</td>
                        <td>{{ array_sum($pria19Sampai21Tahun) }}</td>
                        <td>{{ array_sum($wanita19Sampai21Tahun) }}</td>
                        <td>{{ array_sum($priaDiatas21Tahun) }}</td>
                        <td>{{ array_sum($wanitaDiatas21Tahun) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-end text-xs mt-2">
        <div class="flex-col">
            <p>Mamuju, {{ $tanggalLengkap }}</p>
            <img width="100" src="{{ asset('assets/ttd_kepala_kua/TTD-Kafri.png') }}" alt="TTD">
            <p class="mt-2">Drs. H. MAHMUDDIN, M.Si</p>
        </div>
    </div>

</section>
