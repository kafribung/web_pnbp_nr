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
        @php
            $luarBalaiNikah = [];
            $dalamBalaiNikah    = [];
            $tidakMampu         = [];
            $musibahAlam        = [];
            $sidangIsbat        = [];

            $lakiDibawah19Tahun        = [];
            $perempuanDibawah19Tahun   = [];
            $laki19Sampai21Tahun       = [];
            $perempuan19Sampai21Tahun  = [];
            $lakiDiatas21Tahun         = [];
            $perempuanDiatas21Tahun    = [];

            foreach ($desas as $desa) {
                $luarBalaiNikah[]    .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $dalamBalaiNikah[]   .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Balai Nikah'))->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $tidakMampu[]        .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Kurang Mampu'))->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $musibahAlam[]       .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Bencana Alam'))->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $sidangIsbat[]       .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Isbat'))->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();

                $lakiDibawah19Tahun[]       .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '<', 19)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $perempuanDibawah19Tahun[]  .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '<', 19)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $laki19Sampai21Tahun[]      .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '>=', 19)->where('male_age', '<=', 21)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $perempuan19Sampai21Tahun[] .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '>=', 19)->where('female_age', '<=', 21)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $lakiDiatas21Tahun[]        .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '>', 21)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
                $perempuanDiatas21Tahun[]   .= \App\Models\Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '>', 21)->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            }
        @endphp

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
                        @forelse ($desas as $index => $desa)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-3 py-1 text-xs text-center">{{ $angkaAwal++ }}</td>
                                <td class="px-3 py-1 text-xs">{{ $desa->name }}</td>
                                {{-- Luar Kantor --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $luarBalaiNikah[$index] }}</td>
                                {{-- Kantor/Balai Nikah --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $dalamBalaiNikah[$index] }}</td>
                                {{-- Miskin --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $tidakMampu[$index] }}</td>
                                {{-- Bencana Alam --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $musibahAlam[$index] }}</td>
                                {{-- Isbat --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $sidangIsbat[$index] }}</td>

                                {{-- Jumlah NR --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $jumlahNR = $luarBalaiNikah[$index] + $dalamBalaiNikah[$index] + $tidakMampu[$index] + $musibahAlam[$index] + $sidangIsbat[$index] }}</td>

                                {{-- Total PNBP --}}
                                <td class="px-3 py-1 text-xs text-center">{{ number_format($jumlahPNBP = $luarBalaiNikah[$index] * 600000, 2) }}</td>

                                {{-- Di bawah 19 tahun --}}
                                {{-- Pria --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $lakiDibawah19Tahun[$index] }}</td>
                                {{-- Wanita --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $perempuanDibawah19Tahun[$index] }}</td>

                                {{-- 19-21 tahun --}}
                                {{-- Pria --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $laki19Sampai21Tahun[$index] }}</td>
                                {{-- Wanita --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $perempuan19Sampai21Tahun[$index] }}</td>

                                {{-- Di atas 21 tahun --}}
                                {{-- Pria --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $lakiDiatas21Tahun[$index] }}</td>
                                {{-- Wanita --}}
                                <td class="px-3 py-1 text-xs text-center">{{ $perempuanDiatas21Tahun[$index] }}</td>

                            </tr>

                            @php
                                $totJumlahNR[]              .= $jumlahNR;
                                $totJumlahPNBP[]            .= $jumlahPNBP;
                            @endphp
                        @empty
                        <tr>
                            <td colspan="20" class="px-3 py-1 text-base font-bold justify-center text-center">Data pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
                        </tr>
                        @endforelse
                        <tr class="text-center text-xs font-bold">
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
                        </tr>
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

    <section class="sheet padding-10mm" style="height: 10%">
        <!-- Write HTML just like a web page -->
        <article class="text-xs font-bold text-center uppercase">Data Peristiwa Nikah</article>
        <article class="text-xs font-bold text-center uppercase">Kantor Urusan Agama Kecamatan {{ auth()->user()->kua->name }}</article>
        <article class="text-xs font-bold text-center uppercase">Tahun 2022</article>

        <div class="flex">
            <div class="flex flex-col">
                <div class="text-sm mt-2">Bulan : Januari</div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
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
                            <td class="px-3 py-1 text-xs">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-3 py-1">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold">{{ $pernikahan->male }} Bin {{ $pernikahan->male_father }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->male_age }} tahun</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-1">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold">{{ $pernikahan->female }} Binti {{ $pernikahan->female_father }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->female_age }} tahun</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-1">
                                <div class="flex items-center text-xs">
                                    <div>
                                        <p class="font-semibold"> {{ $pernikahan->desa->name }} </p>
                                        @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ number_format($pernikahan->transport, 2) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-1 text-xs"> {{ $pernikahan->marriage_certificate_number }} </td>
                            <td class="px-3 py-1 text-xs"> {{ $pernikahan->perforation_number }} </td>
                            <td class="px-3 py-1 text-xs"> {{ $pernikahan->penghulu->name ?? null }} </td>
                            <td class="px-3 py-1 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('dddd')  }} </td>
                            <td class="px-3 py-1 text-xs"> {{  date('d M Y', strtotime($pernikahan->date_time)) }} </td>
                            {{-- <td class="px-3 py-1 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('d MMM Y')  }} </td> --}}
                            <td class="px-3 py-1 text-xs font-semibold"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                        </tr>
                        @empty
                            <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <div class="flex justify-end text-xs mt-2">
            <div class="flex-col">
                <p>Baubau, 12 Desember 2022</p>
                <p>Kepala KUA</p>
                <p class="mt-14">{{ auth()->user()->kua->penghulus->where('kua_leader', 1)->first()->name }}</p>
            </div>
        </div>

    </section>

</body>

</html>
