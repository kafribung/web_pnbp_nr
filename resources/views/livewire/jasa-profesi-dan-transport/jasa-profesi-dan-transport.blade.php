<div>
    @livewire('pernikahan.form')
    <x-navbar> Data Profesi dan Transport Layanan Perkawinan </x-navbar>
    <x-cta> Berisi data Profesi dan Transport di KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message>{{ session('message') }}</x-message>
            @endif
            <div>
                <div class="flex justify-start">
                    <div class="mt-1">
                        <x-search>
                            <x-input class="pl-8 pr-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                        </x-search>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button-add wire:click="$emitTo('pernikahan.form', 'create')"></x-button-add>
                </div>
            </div>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" rowspan="2">No</th>
                        <th class="px-4 py-3" rowspan="2">Nama Pelaksana</th>
                        <th class="px-4 py-3" rowspan="2">Pangkat/Gol</th>
                        <th class="px-4 py-3" rowspan="2">Jml NR</th>
                        <th class="px-4 py-3" rowspan="2">Satuan PNBP</th>
                        <th class="px-4 py-3 text-center" colspan="2">Transport</th>
                        <th class="px-4 py-3 text-center" colspan="4">Jasa Profesi</th>
                        <th class="px-4 py-3" rowspan="2">Jumlah Permohonan Pembayaran</th>
                        <th class="px-4 py-3" rowspan="2">Aksi</th>
                    </tr>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Satuan</th>
                        <th class="px-4 py-3">Jumalah</th>

                        <th class="px-4 py-3">Satuan</th>
                        <th class="px-4 py-3">Jumalah</th>
                        <th class="px-4 py-3">PPH</th>
                        <th class="px-4 py-3">Jumlah Setelah Pengurahan PPH</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    {{-- @forelse ($pernikahans as $index => $pernikahan)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ (($pernikahans->currentPage() - 1 ) * $pernikahans->perPage() ) + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ $pernikahan->male }} Bin {{ $pernikahan->male_father }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->male_age }} tahun</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{ $pernikahan->female }} Binti {{ $pernikahan->female_father }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->female_age }} tahun</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->village }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->marriage_certificate_number }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->perforation_number }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->penghulu->name ?? null }} </td>
                        <td class="px-4 py-3 text-sm"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('dddd')  }} </td>
                        <td class="px-4 py-3 text-sm"> {{  date('d M Y', strtotime($pernikahan->date_time)) }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('pernikahan.form', 'edit', {{ $pernikahan->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('pernikahan.form', 'delete', {{ $pernikahan->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="10" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
        {{-- {{ $pernikahans->links() }} --}}
    </div>
</div>