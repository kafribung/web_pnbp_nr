<div>
    @livewire('pernikahan.form')
    <x-navbar> Data Pernikahan </x-navbar>
    <x-cta> Berisi data pernikahan di KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message type="message">{{ session('message') }}</x-message>
            @endif
            @if (session('error'))
            <x-message type="error" >{{ session('error') }}</x-message>
            @endif
            <div>
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
                    <div class="ml-2">
                        <x-select class="text-sm" wire:model="filterAge">
                            @slot('option_default', 'Filter Umur')
                            <optgroup label="Pria">
                                <option value="p<19">Pria < 19 Tahun</option>
                                <option value="p>=19&&<=21">Pria 19 - 21 Tahun</option>
                                <option value="p>21">Pria > 21 Tahun</option>
                            </optgroup>
                            <optgroup label="Wanita">
                                <option value="w<19">Wanita < 19 Tahun</option>
                                <option value="w>=19&&<=21">Wanita 19 - 21 Tahun</option>
                                <option value="w>21">Wanita > 21 Tahun</option>
                            </optgroup>
                        </x-select>
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
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Catin Pria</th>
                        <th class="px-4 py-3">Catin Wanita</th>
                        <th class="px-4 py-3">Desa / Kelurahan</th>
                        <th class="px-4 py-3">Nomor Akta</th>
                        <th class="px-4 py-3">Nomor Seri Porposisi</th>
                        <th class="px-4 py-3">Nama Penghulu</th>
                        <th class="px-4 py-3">Hari</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Peristiwa Nikah</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($pernikahans as $index => $pernikahan)
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
                        {{-- <td class="px-4 py-3 text-sm"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('d MMM Y')  }} </td> --}}
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('pernikahan.form', 'edit', {{ $pernikahan->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('pernikahan.form', 'delete', {{ $pernikahan->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pernikahans->links() }}
    </div>
</div>
