<html>

<head>
    <title>Cetak Hasil</title>
    <style>
        .kop {
            text-align: center;
            margin-top: 20px;
        }
        .kop .address {
            font-size: 10pt;
            margin-top: -15px;
        }
        .content {
            width: auto;
            height: auto;
            position: absolute;
            margin-top: 10px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

        p {
            line-height: 20pt;
        }
        table,
        th,
        td {
            border: 1px solid black;
            width: fit-content;
            padding: 8px;
            border-collapse: collapse;
        }

        .signature {
            float: right;
        }
    </style>
</head>

<body>
    <div class="kop">
        <h3>Rumah Bibit Kelurahan Lakologou</h3>
        <p class="kop address">Jl. Anoa Kel. Lakologou, Kec. Kokalukuna, Kota Baubau, Sulawesi Tenggara</p>
    </div>
    </div>
    <div class="content">
        <p>Berikut adalah hasil pengujian tanaman yang diperoleh dari Sistem Pendukung Keputusan yang dapat digunakan
            sebagai pertimbangan untuk bibit tanaman yang akan tetap dikembangkan di Rumah Bibit Kelurahan Lakologou,
            Kec. Kokalukuna, Kota Baubau yang dilakukan
            pada:<br>
            Hari: Senin
            {{-- <br>Pukul: {{ $hasil->created_at->format('h:i') }} WITA
            <br>Tanggal: {{ $hasil->created_at->format('d-m-Y') }}
            <br>Penguji: {{ $hasil->user->name }} --}}
        </p>
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

        <table>
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">Kelurahan/Desa</th>
                    <th rowspan="3">Luar Kantor</th>
                    <th colspan="4">Bebas Biaya</th>
                    <th rowspan="3">Jml NR</th>
                    <th rowspan="3">Total PNBP</th>
                    <th colspan="6">Berdasarkan Usia</th>
                </tr>
                <tr>
                    <th rowspan="2">Kantor</th>
                    <th rowspan="2">Miskin</th>
                    <th rowspan="2">Bencana Alam</th>
                    <th rowspan="2">Isbat</th>

                    <th colspan="2">Di Bawah 19 Thn</th>
                    <th colspan="2">19 s.d 21 Thn</th>
                    <th colspan="2">Di Atas 21 Thn</th>
                </tr>
                <tr>
                    <th>Pria</th>
                    <th>Wanita</th>

                    <th>Pria</th>
                    <th>Wanita</th>

                    <th>Pria</th>
                    <th>Wanita</th>
                </tr>
            </thead>

            <tbody>
                <tr>
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
                    <tr>
                        <td>{{ $angkaAwal++ }}</td>
                        <td>{{ $desa->name }}</td>
                        {{-- Luar Kantor --}}
                        <td>{{ $luarBalaiNikah[$index] }}</td>
                        {{-- Kantor/Balai Nikah --}}
                        <td>{{ $dalamBalaiNikah[$index] }}</td>
                        {{-- Miskin --}}
                        <td>{{ $tidakMampu[$index] }}</td>
                        {{-- Bencana Alam --}}
                        <td>{{ $musibahAlam[$index] }}</td>
                        {{-- Isbat --}}
                        <td>{{ $sidangIsbat[$index] }}</td>

                        {{-- Jumlah NR --}}
                        <td>{{ $jumlahNR = $luarBalaiNikah[$index] + $dalamBalaiNikah[$index] + $tidakMampu[$index] + $musibahAlam[$index] + $sidangIsbat[$index] }}</td>

                        {{-- Total PNBP --}}
                        <td>{{ number_format($jumlahPNBP = $luarBalaiNikah[$index] * 600000, 2) }}</td>

                        {{-- Di bawah 19 tahun --}}
                        {{-- Pria --}}
                        <td>{{ $lakiDibawah19Tahun[$index] }}</td>
                        {{-- Wanita --}}
                        <td>{{ $perempuanDibawah19Tahun[$index] }}</td>

                        {{-- 19-21 tahun --}}
                        {{-- Pria --}}
                        <td>{{ $laki19Sampai21Tahun[$index] }}</td>
                        {{-- Wanita --}}
                        <td>{{ $perempuan19Sampai21Tahun[$index] }}</td>

                        {{-- Di atas 21 tahun --}}
                        {{-- Pria --}}
                        <td>{{ $lakiDiatas21Tahun[$index] }}</td>
                        {{-- Wanita --}}
                        <td>{{ $perempuanDiatas21Tahun[$index] }}</td>

                    </tr>

                    @php
                        $totJumlahNR[]              .= $jumlahNR;
                        $totJumlahPNBP[]            .= $jumlahPNBP;
                    @endphp
                @empty
                <tr>
                    <td colspan="20">Data pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
                </tr>
                @endforelse
                <tr>
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

        <p>Demikian hasil ini dibuat untuk dapat dijadikan pertimbangan pengadaan bibit selanjutnya.</p>

        <div class="signature">
            <p>Baubau, 12 Desember 2021</p>
            <p>Mengetahui,</p>
            <p>Ketua Rumah Bibit Kelurahan Lakologou</p>
            <br>
            <br>
            <br>
            <p>(..................................)</p>
        </div>
    </div>

</body>

</html>
