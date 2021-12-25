<div>
    @livewire('pernikahan.form')
    <x-navbar>
        <a href="{{ route('jasa-profesi-dan-transport') }}" class="font-bold">Jasa profesi & transport</a>
    </x-navbar>
    <x-cta> Menampilan semua biaya jasa profesi dan tansport di KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message type="message">{{ session('message') }}</x-message>
            @endif
            <div class="mb-6">
                <div class="flex justify-start">
                    <div class="mt-1">
                        <x-search>
                            <x-input class="pl-8 pr-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                        </x-search>
                    </div>
                    <div class="ml-2">
                        <x-select class="text-sm" wire:model="currnetMonth">
                            @slot('option_default', 'Filter Bulan')
                            @php
                                $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                            @endphp
                            @for ($i = 0; $i < count($month); $i++)
                            <option value="{{ $i + 1 }}">{{ $month[$i] }}</option>
                            @endfor
                        </x-select>
                    </div>
                    <div class="ml-2">
                        <x-select class="text-sm" wire:model="currnetYear">
                            @slot('option_default', 'Filter Tahun')
                            @for ($oldYear; $oldYear <= $lastYear; $oldYear++)
                            <option value="{{ $oldYear }}">{{ $oldYear }}</option>
                            @endfor
                        </x-select>
                    </div>
                </div>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" rowspan="2">No</th>
                        <th class="px-4 py-3" rowspan="2">Penghulu</th>
                        <th class="px-4 py-3" rowspan="2">Gol</th>
                        <th class="px-4 py-3" rowspan="2">Jml NR</th>
                        <th class="px-4 py-3" rowspan="2">Satuan PNBP</th>
                        <th class="px-4 py-3" rowspan="2">Jml PNBP</th>
                        <th class="px-4 py-3 text-center" colspan="2">Transport</th>
                        <th class="px-4 py-3 text-center" colspan="4">Jasprof</th>
                        <th class="px-4 py-3" rowspan="2">Jml Permhn Pembyaran</th>
                    </tr>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700  dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-center bg-gray-200">Satuan</th>
                        <th class="px-4 py-3 text-center bg-gray-200">Jml</th>

                        <th class="px-4 py-3 text-center bg-gray-300">Satuan</th>
                        <th class="px-4 py-3 text-center bg-gray-300">Jml</th>
                        <th class="px-4 py-3 text-center bg-gray-300">PPH</th>
                        <th class="px-4 py-3 text-center bg-gray-300">Jml Pengurangan PPH</th>
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
                    @forelse ($penghulus as $index => $penghulu)

                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-xs text-center">
                            {{ $index+1 }}
                        </td>
                        <td class="px-4 py-3 text-xs font-semibold "> {{ $penghulu->name }} </td>
                        <td class="px-4 py-3 text-xs"> {{ $penghulu->golongan->name }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{$jumlahNR = $penghulu->pernikahans()->whereMonth('date_time', $currnetMonth)->whereYear('date_time', $currnetYear)->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->count() }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($satuanPnbpNr = 600000, 2)  }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jumlahPNBP   = $satuanPnbpNr * $jumlahNR, 2) }} </td>

                        {{-- Transport --}}
                        @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jasaTransport= $penghulu->pernikahans()->sum('transport'), 2) }} </td>
                        @else
                        {{-- Jika KUa tipologi C --}}
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jasaTransport= 100000, 2) }} </td>
                        @endif
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jumTransport = $jumlahNR * $jasaTransport, 2) }} </td>

                        {{-- Jasa Profesi --}}
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jasPro         = $penghulu->jasa_profesi, 2) }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jumJasaProfesi = $jasPro * $jumlahNR, 2) }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($pph        = $penghulu->pph($jumJasaProfesi), 2) }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jumPengPPH = $jumJasaProfesi - $pph, 2) }} </td>
                        <td class="px-4 py-3 text-xs text-center"> {{ number_format($jumPerPem  = $jumTransport + $jumPengPPH, 2) }} </td>

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
                            $totJumPerPem[]          .= $jumPerPem;
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
</div>
