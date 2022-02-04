<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4 landscape</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4 landscape
        }
    </style>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape container ">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
        <!-- Write HTML just like a web page -->
        <article class="text-xs font-bold text-center uppercase">Laporan Peristiwa Nikah Rujuk PerKelurahan/Desa</article>
        <article class="text-xs font-bold text-center uppercase">Kantor Urusan Agama Kecamatan {{ auth()->user()->kua->name }}</article>
        <article class="text-xs font-bold text-center uppercase">Tahun 2022</article>

        <div class="flex">
            <div class="flex flex-col">
                <div class="text-xs mt-2">Bulan : Januari</div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-1" rowspan="3">No</th>
                            <th class="px-3 py-1" rowspan="3">Kelurahan/Desa</th>
                            <th class="px-3 py-1" rowspan="3">Luar Kantor</th>
                            <th class="px-3 py-1 text-center" colspan="4">Bebas Biaya</th>
                            <th class="px-3 py-1" rowspan="3">Jml NR</th>
                            <th class="px-3 py-1" rowspan="3">Total PNBP</th>
                            <th class="px-3 py-1 text-center" colspan="6">Berdasarkan Usia</th>
                        </tr>
                        <tr class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-1" rowspan="2">Kantor</th>
                            <th class="px-3 py-1" rowspan="2">Miskin</th>
                            <th class="px-3 py-1" rowspan="2">Bencana Alam</th>
                            <th class="px-3 py-1" rowspan="2">Isbat</th>

                            <th class="px-3 py-1" colspan="2">Di Bawah 19 Thn</th>
                            <th class="px-3 py-1" colspan="2">19 s.d 21 Thn</th>
                            <th class="px-3 py-1" colspan="2">Di Atas 21 Thn</th>
                        </tr>
                        <tr class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
                            $angkaAwal        = 1;
                            $totJumlahNR      = [];
                            $totJumlahPNBP    = [];

                            $luarBalaiNikah   = [];
                            $balaiNikah       = [];
                            $kurangMampu      = [];
                            $bencanaAlam      = [];
                            $isbat            = [];

                            $priaDibawah19Tahun     = [];
                            $wanitaDibawah19Tahun   = [];
                            $pria19Sampai21Tahun    = [];
                            $wanita19Sampai21Tahun  = [];
                            $priaDiatas21Tahun      = [];
                            $wanitaDiatas21Tahun    = [];
                        @endphp
                        @forelse ($desas->unique('name') as $index => $desa)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 text-xs text-center">{{ $angkaAwal++ }}</td>
                            <td class="px-4 text-xs">{{ $desa->name }}</td>
                            {{-- Luar Kantor --}}
                            <td class="px-4 text-xs text-center">{{ $desa->luar_balai_nikah_count }}</td>
                            {{-- Kantor/Balai Nikah --}}
                            <td class="px-4 text-xs text-center">{{ $desa->balai_nikah_count }}</td>
                            {{-- Miskin --}}
                            <td class="px-4 text-xs text-center">{{ $desa->kurang_mampu_count }}</td>
                            {{-- Bencana Alam --}}
                            <td class="px-4 text-xs text-center">{{ $desa->bencana_alam_count }}</td>
                            {{-- Isbat --}}
                            <td class="px-4 text-xs text-center">{{ $desa->isbat_count }}</td>

                            {{-- Jumlah NR --}}
                            <td class="px-4 text-xs text-center">{{ $jumlahNR = $desa->luar_balai_nikah_count + $desa->balai_nikah_count + $desa->kurang_mampu_count + $desa->bencana_alam_count + $desa->isbat_count }}</td>

                            {{-- Total PNBP --}}
                            <td class="px-4 text-xs text-center">{{ number_format($jumlahPNBP = $desa->luar_balai_nikah_count * 600000, 2) }}</td>

                            {{-- Di bawah 19 tahun --}}
                            {{-- Pria --}}
                            <td class="px-4 text-xs text-center">{{ $desa->pria_dibawah_19_tahun_count }}</td>
                            {{-- Wanita --}}
                            <td class="px-4 text-xs text-center">{{ $desa->wanita_dibawah_19_tahun_count }}</td>

                            {{-- 19-21 tahun --}}
                            {{-- Pria --}}
                            <td class="px-4 text-xs text-center">{{ $desa->pria_19_sampai_21_tahun_count }}</td>
                            {{-- Wanita --}}
                            <td class="px-4 text-xs text-center">{{ $desa->wanita_19_sampai_21_tahun_count }}</td>

                            {{-- Di atas 21 tahun --}}
                            {{-- Pria --}}
                            <td class="px-4 text-xs text-center">{{ $desa->pria_diatas_21_tahun_count }}</td>
                            {{-- Wanita --}}
                            <td class="px-4 text-xs text-center">{{ $desa->wanita_diatas_21_tahun_count }}</td>
                        </tr>
                        @php
                            $totJumlahNR[]              .= $jumlahNR;
                            $totJumlahPNBP[]            .= $jumlahPNBP;

                            $luarBalaiNikah[]           .= $desa->luar_balai_nikah_count;
                            $balaiNikah[]               .= $desa->balai_nikah_count;
                            $kurangMampu[]              .= $desa->kurang_mampu_count;
                            $bencanaAlam[]              .= $desa->bencana_alam_count;
                            $isbat[]                    .= $desa->isbat_count;

                            $priaDibawah19Tahun[]       .= $desa->pria_dibawah_19_tahun_count;
                            $wanitaDibawah19Tahun[]     .= $desa->wanita_dibawah_19_tahun_count;
                            $pria19Sampai21Tahun[]      .= $desa->pria_19_sampai_21_tahun_count;
                            $wanita19Sampai21Tahun[]    .= $desa->wanita_19_sampai_21_tahun_count;
                            $priaDiatas21Tahun[]        .= $desa->pria_diatas_21_tahun_count;
                            $wanitaDiatas21Tahun[]      .= $desa->wanita_diatas_21_tahun_count;
                        @endphp
                        @empty
                        <tr>
                            <td colspan="20" class="px-4 text-base font-bold justify-center text-center">Data pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
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
                <p>Baubau, 01 Januari 2022</p>
                <p>Kepala KUA</p>
                <img width="100" src="{{ asset(auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->takeImg) }}" alt="TTD">
                <p class="mt-2">{{ auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->name }}</p>
            </div>
        </div>

    </section>

    {{-- Data pernikahan --}}
    <section class="sheet padding-10mm">
        <!-- Write HTML just like a web page -->
        <article class="text-xs font-bold text-center uppercase">Data Peristiwa Nikah</article>
        <article class="text-xs font-bold text-center uppercase">Kantor Urusan Agama Kecamatan {{ auth()->user()->kua->name }}</article>
        <article class="text-xs font-bold text-center uppercase">Tahun 2022</article>

        <div class="flex">
            <div class="flex flex-col">
                <div class="text-xs mt-2">Bulan : Januari</div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-1">No</th>
                            <th class="px-3 py-1">Catin Pria</th>
                            <th class="px-3 py-1">Catin Wanita</th>
                            <th class="px-3 py-1">Desa / Kelurahan</th>
                            <th class="px-3 py-1">Nomor Akta</th>
                            <th class="px-3 py-1">Nomor Seri Porposisi</th>
                            <th class="px-3 py-1">Nama Penghulu</th>
                            <th class="px-3 py-1">Hari</th>
                            <th class="px-3 py-1">Tanggal</th>
                            <th class="px-3 py-1">Peristiwa Nikah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($pernikahans as $index => $pernikahan)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-3 text-xs">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-3">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold">{{ $pernikahan->male }} Bin {{ $pernikahan->male_father }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->male_age }} tahun</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold">{{ $pernikahan->female }} Binti {{ $pernikahan->female_father }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->female_age }} tahun</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold"> {{ $pernikahan->desa->name }} </p>
                                        @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ number_format($pernikahan->transport, 2) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 text-xs"> {{ $pernikahan->marriage_certificate_number }} </td>
                            <td class="px-3 text-xs"> {{ $pernikahan->perforation_number }} </td>
                            <td class="px-3 text-xs"> {{ $pernikahan->penghulu->name ?? null }} </td>
                            <td class="px-3 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('dddd')  }} </td>
                            <td class="px-3 text-xs"> {{  date('d M Y', strtotime($pernikahan->date_time)) }} </td>
                            {{-- <td class="px-3 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('d MMM Y')  }} </td> --}}
                            <td class="px-3 text-xs font-semibold"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                        </tr>
                        @empty
                            <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end text-xs mt-2">
            <div class="flex-col">
                <p>Baubau, 12 Desember 2022</p>
                <img width="100" src="{{ asset(auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->takeImg) }}" alt="TTD">
                <p class="mt-2">{{ auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->name }}</p>
            </div>
        </div>

    </section>

    {{-- Jasa Profesi --}}
    <section class="sheet padding-10mm">
        <!-- Write HTML just like a web page -->
        <article class="text-xs font-bold text-center uppercase">Permohonan Pencairan Jasa Profesi Transportasi Layanan Perkawinan</article>
        <article class="text-xs font-bold text-center uppercase">Kantor Urusan Agama Kecamatan {{ auth()->user()->kua->name }}</article>
        <article class="text-xs font-bold text-center uppercase">Tahun 2022</article>

        <div class="flex">
            <div class="flex flex-col">
                <div class="text-xs mt-2">Tipologi KUA : {{ auth()->user()->kua->typology->name }} </div>
                <div class="text-xs mt-2">Bulan : Januari</div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-1" rowspan="2">No</th>
                            <th class="px-3 py-1" rowspan="2">Penghulu</th>
                            <th class="px-3 py-1" rowspan="2">Gol</th>
                            <th class="px-3 py-1" rowspan="2">Jml NR</th>
                            <th class="px-3 py-1" rowspan="2">Satuan PNBP</th>
                            <th class="px-3 py-1" rowspan="2">Jml PNBP</th>
                            <th class="px-3 py-1 text-center" colspan="2">Transport</th>
                            <th class="px-3 py-1 text-center" colspan="4">Jasprof</th>
                            <th class="px-3 py-1" rowspan="2">Jml Permhn Pembyaran</th>
                        </tr>
                        <tr class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-3 py-1 text-center bg-gray-200">Satuan</th>
                            <th class="px-3 py-1 text-center bg-gray-200">Jml</th>

                            <th class="px-3 py-1 text-center bg-gray-300">Satuan</th>
                            <th class="px-3 py-1 text-center bg-gray-300">Jml</th>
                            <th class="px-3 py-1 text-center bg-gray-300">PPH</th>
                            <th class="px-3 py-1 text-center bg-gray-300">Jml Pengurangan PPH</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr class="text-center text-xs font-semibold">
                            <td>a</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                            <td>e</td>
                            <td>f=d*e</td>
                            <td>g</td>
                            <td>h=d*g</td>
                            <td>i</td>
                            <td>j=d*i</td>
                            <td>k=j*5% | j*15%</td>
                            <td>l=j-k</td>
                            <td>m=h+l</td>
                        </tr>
                        {{-- Set array variable --}}
                        @php
                            $angkaAwal        = 1;
                            $totJumlahNR      = [];
                            $totSatuanPnbpNr  = [];
                            $totJumlahPNBP    = [];

                            $totJasaTransport = [];
                            $totJumTransport  = [];

                            $totJasPro        = [];
                            $totJumJasaProfesi= [];
                            $totPPH           = [];
                            $totJumPengPPH    = [];
                            $totJumPerPem     = [];
                        @endphp
                        @forelse ($penghulus->unique('name') as $index => $penghulu)

                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-1 text-xs text-center">
                                {{ $angkaAwal++ }}
                            </td>
                            <td class="px-1 text-xs font-semibold "> {{ $penghulu->name }} </td>
                            <td class="px-1 text-xs"> {{ $penghulu->golongan->name }} </td>
                            <td class="px-1 text-xs text-center"> {{$jumlahNR = $penghulu->luar_balai_nikah_count }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($satuanPnbpNr = 600000, 2)  }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($jumlahPNBP   = $satuanPnbpNr * $jumlahNR, 2) }} </td>
                            {{-- Transport --}}
                            @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                            <td class="px-1 text-xs text-center"> {{ number_format($jasaTransport= $penghulu->pernikahans()->sum('transport'), 2) }} </td>
                            @else
                            {{-- Jika KUa tipologi C --}}
                            <td class="px-1 text-xs text-center"> {{ number_format($jasaTransport= 100000, 2) }} </td>
                            @endif
                            <td class="px-1 text-xs text-center"> {{ number_format($jumTransport = $jumlahNR * $jasaTransport, 2) }} </td>

                            {{-- Jasa Profesi --}}
                            <td class="px-1 text-xs text-center"> {{ number_format($jasPro         = $penghulu->jasa_profesi, 2) }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($jumJasaProfesi = $jasPro * $jumlahNR, 2) }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($pph        = $penghulu->pph($jumJasaProfesi), 2) }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($jumPengPPH = $jumJasaProfesi - $pph, 2) }} </td>
                            <td class="px-1 text-xs text-center"> {{ number_format($jumPerPem  = $jumTransport + $jumPengPPH, 2) }} </td>

                            @php
                                $totJumlahNR[]        .= $jumlahNR;
                                $totSatuanPnbpNr[]    .= $satuanPnbpNr;
                                $totJumlahPNBP[]      .= $jumlahPNBP;

                                $totJasaTransport[]   .= $jasaTransport;
                                $totJumTransport[]    .= $jumTransport;

                                $totJasPro[]          .= $jasPro;
                                $totJumJasaProfesi[]  .= $jumJasaProfesi;
                                $totPPH[]             .= $pph;
                                $totJumPengPPH[]      .= $jumPengPPH;
                                $totJumPerPem[]       .= $jumPerPem;
                            @endphp
                        </tr>
                        @empty
                            <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                        @endforelse
                        <tr class="text-center text-xs font-bold">
                            <td colspan="3">Jumlah</td>
                            <td>{{ array_sum($totJumlahNR) }}</td>
                            <td>{{ number_format( array_sum($totSatuanPnbpNr), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJumlahPNBP), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJasaTransport), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJumTransport), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJasPro), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJumJasaProfesi), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totPPH), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJumPengPPH), 2 ) }}</td>
                            <td>{{ number_format( array_sum($totJumPerPem), 2 ) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end text-xs mt-2">
            <div class="flex-col">
                <p>Baubau, 12 Desember 2022</p>
                <img width="100" src="{{ asset(auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->takeImg) }}" alt="TTD">
                <p class="mt-2">{{ auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->name }}</p>
            </div>
        </div>

    </section>

</body>

</html>
