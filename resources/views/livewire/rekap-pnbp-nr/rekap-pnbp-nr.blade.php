<div>
    @livewire('pernikahan.form')
    <x-navbar>
        <a href="{{ route('rekap-pnbp-nr') }}" class="font-bold">Rekapan PNBP-NR</a>
    </x-navbar>
    <x-cta> Menampikan semua data rekapan PNBP-NR di KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message type="message">{{ session('message') }}</x-message>
            @endif
            @if (session('error'))
            <x-message type="error" >{{ session('error') }}</x-message>
            @endif
            <div class="mb-6">
                <div class="flex justify-start">
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

            <div class="my-3">
                <p class="text-sm"><span class="font-semibold">**Catatan!</span> Setiap tanggal 5 data akan direkap dan diperiksa oleh admin KEMENAG Mamuju.</p>
            </div>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Bulan</th>
                        <th class="px-4 py-3">Peristiwa Nikah</th>
                        <th class="px-4 py-3">Total PNBP NR</th>
                        <th class="px-4 py-3">Kategori Usia</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($months as $index => $month)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ $index+1 }}
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $month }} </td>
                        <td class="px-4 py-3 text-sm">
                            <ul class="list-disc">
                                <li>Luar Balai: {{ $luarBalai = $luarBalaiNikah[$index] }}</li>
                                <li>Balai: {{ $balai = $balaiNikah[$index] }}</li>
                                <li>Kurang Mampu: {{ $tidakMampu = $kurangMampu[$index] }}</li>
                                <li>Bencana Alam: {{ $bencana = $bencanaAlam[$index] }}</li>
                                <li>Isbat: {{$sidang = $isbat[$index] }}</li>
                                <li class="font-bold">Total: {{ $luarBalai + $balai + $tidakMampu + $bencana + $sidang }}</li>
                            </ul>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ number_format($luarBalai * 600000, 2)  }} </td>
                        <td class="px-4 py-3 text-sm">
                            <ul id="custom-list" class="list-disc">
                                <p class="font-bold">Di bawah 19 tahun:</p>
                                <li>Laki-laki: {{ $lakiLakidiBawah19Tahun[$index] }}</li>
                                <li>Perempuan: {{ $perempuandiBawah19Tahun[$index] }}</li>
                            </ul>
                            <ul id="custom-list" class="list-disc">
                                <p class="font-bold">19 s.d 21 tahun:</p>
                                <li>Laki-laki: {{ $lakiLaki19Sampai21Tahun[$index] }}</li>
                                <li>Perempuan: {{ $perempuan19Sampai21Tahun[$index] }}</li>
                            </ul>
                            <ul id="custom-list" class="list-disc">
                                <p class="font-bold">Di atas 21 tahun:</p>
                                <li>Laki-laki: {{ $lakiLakidiAtas21Tahun[$index] }}</li>
                                <li>Perempuan: {{ $perempuandiAtas21Tahun[$index] }}</li>
                            </ul>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm"> - </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-button-edit-delete metode='print' wire:click="" class="hover:text-gray-700 text-gray-600 focus:shadow-outline-gray"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@push('mycss')
<style>
    #custom-list > li {
        margin-left: 30px;
    }
</style>
@endpush
</div>
