<div>
    @livewire('pernikahan.form')
    <x-navbar>
        <a href="{{ route('pernikahan') }}" class="font-bold">Pernikahan</a>
    </x-navbar>
    <x-cta> Menampikan semua data pernikahan di KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message type="message">{{ session('message') }}</x-message>
            @endif
            @if (session('error'))
            <x-message type="error" >{{ session('error') }}</x-message>
            @endif
            <div class="mb-6 mt-2">
                <div class="flex justify-start">
                    <div class="mr-2">
                        <x-search>
                            <x-input class="pl-8 pr-2 ml-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                        </x-search>
                    </div>
                    @if (!auth()->user()->kua_id)
                    <div class="ml-2">
                        <x-select class="text-sm" wire:model="filterKua">
                            @slot('option_default', 'Pilih KUA')
                            @foreach ($kuas as $kua)
                            <option value="{{ $kua->id }}">{{ $kua->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    @endif
                    <div class="ml-2">
                        <x-date-picker
                        class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm text-gray-700 border-gray-300 rounded-md"
                        wire:model="dateRange" />
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
                    @if (auth()->user()->kua_id)
                    <x-button-add wire:click="$emitTo('pernikahan.form', 'create')"></x-button-add>
                    @endif
                </div>
            </div>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
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
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold"> {{ $pernikahan->desa->name }} </p>
                                    @if (auth()->user()->kua)
                                        @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ number_format($pernikahan->transport, 2) }}</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->marriage_certificate_number }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->perforation_number }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->penghulu->name ?? null }} </td>
                        <td class="px-4 py-3 text-sm"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('dddd')  }} </td>
                        <td class="px-4 py-3 text-sm"> {{  date('d M Y', strtotime($pernikahan->date_time)) }} </td>
                        {{-- <td class="px-4 py-3 text-sm"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('d MMM Y')  }} </td> --}}
                        <td class="px-4 py-3 text-sm font-semibold"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                @if (auth()->user()->kua)
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('pernikahan.form', 'edit', {{ $pernikahan->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('pernikahan.form', 'delete', {{ $pernikahan->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                                @endif
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
