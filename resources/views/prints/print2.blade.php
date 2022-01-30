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
                <div class="text-sm mt-2">Bulan : Januari</div>
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
                            $angkaAwal           = 1;

                            $totJumlahNR         = [];
                            $totJumlahPNBP       = [];
                        @endphp
                        @forelse ($desas->unique('desa') as $index => $desa)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-3 py-1 text-xs text-center">{{ $angkaAwal++ }}</td>
                                <td class="px-3 py-1 text-xs">{{ $desa->desa }}</td>
                                {{-- Luar Kantor --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $desa->luar_balai_nikah_count }}</td>
                                {{-- Kantor/Balai Nikah --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $dalamBalaiNikah[$index] }}</td> --}}
                                {{-- Miskin --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $tidakMampu[$index] }}</td> --}}
                                {{-- Bencana Alam --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $musibahAlam[$index] }}</td> --}}
                                {{-- Isbat --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $sidangIsbat[$index] }}</td> --}}

                                {{-- Jumlah NR --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $jumlahNR = $luarBalaiNikah[$index] + $dalamBalaiNikah[$index] + $tidakMampu[$index] + $musibahAlam[$index] + $sidangIsbat[$index] }}</td> --}}

                                {{-- Total PNBP --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ number_format($jumlahPNBP = $luarBalaiNikah[$index] * 600000, 2) }}</td> --}}

                                {{-- Di bawah 19 tahun --}}
                                {{-- Pria --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $lakiDibawah19Tahun[$index] }}</td> --}}
                                {{-- Wanita --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $perempuanDibawah19Tahun[$index] }}</td> --}}

                                {{-- 19-21 tahun --}}
                                {{-- Pria --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $laki19Sampai21Tahun[$index] }}</td> --}}
                                {{-- Wanita --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $perempuan19Sampai21Tahun[$index] }}</td> --}}

                                {{-- Di atas 21 tahun --}}
                                {{-- Pria --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $lakiDiatas21Tahun[$index] }}</td> --}}
                                {{-- Wanita --}}
                                {{-- <td class="px-3 py-1 text-xs text-center">{{ $perempuanDiatas21Tahun[$index] }}</td> --}}

                            </tr>

                            {{-- @php
                                $totJumlahNR[]              .= $jumlahNR;
                                $totJumlahPNBP[]            .= $jumlahPNBP;
                            @endphp --}}
                        @empty
                        <tr>
                            <td colspan="20" class="px-3 py-1 text-base font-bold justify-center text-center">Data pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
                        </tr>
                        @endforelse
                        {{-- <tr class="text-center text-xs font-bold">
                            <td colspan="2">Jumlah</td>
                            <td>{{ array_sum($luarBalaiNikah) }}</td>
                            <td>{{ array_sum($dalamBalaiNikah) }}</td>
                            <td>{{ array_sum($tidakMampu) }}</td>
                            <td>{{ array_sum($musibahAlam) }}</td>
                            <td>{{ array_sum($sidangIsbat) }}</td>

                            <td>{{ array_sum($totJumlahNR) }}</td>
                            <td>{{ number_format( array_sum($totJumlahPNBP), 2 ) }}</td>

                            <td>{{ array_sum($lakiDibawah19Tahun) }}</td>
                            <td>{{ array_sum($perempuanDibawah19Tahun) }}</td>
                            <td>{{ array_sum($laki19Sampai21Tahun) }}</td>
                            <td>{{ array_sum($perempuan19Sampai21Tahun) }}</td>
                            <td>{{ array_sum($lakiDiatas21Tahun) }}</td>
                            <td>{{ array_sum($perempuanDiatas21Tahun) }}</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end text-xs mt-2">
            <div class="flex-col">
                <p>Baubau, 01 Januari 2022</p>
                <p>Kepala KUA</p>
                <p class="mt-14">{{ auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->name }}</p>
            </div>
        </div>

    </section>



</body>

</html>
