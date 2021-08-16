<div>
    {{-- @livewire('staf-kua.form') --}}
    <x-navbar> Data Pernikahan </x-navbar>
    <x-cta> Berisi data pernikahan di KUA {{ auth()->user()->kua ?? '' }} </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message>{{ session('message') }}</x-message>
            @endif
            <div class="flex justify-between mt-2">
                <x-search>
                    <x-input class="pl-8 pr-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                </x-search>
                {{-- <x-button-add wire:click="$emitTo('staf-kua.form', 'create')"></x-button-add> --}}
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
                                <!-- Avatar with inset shadow -->
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ $pernikahan->name }}&background=059669&color=fff&bold=true"
                                        alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $pernikahan->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400"> Staf KUA {{ $pernikahan->kua->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $pernikahan->email }} </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                {{-- <x-button-edit-delete metode='edit' wire:click="$emitTo('staf-kua.form', 'edit', {{ $pernikahan->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('staf-kua.form', 'delete', {{ $pernikahan->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="10" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pernikahans->links() }}
    </div>
</div>
