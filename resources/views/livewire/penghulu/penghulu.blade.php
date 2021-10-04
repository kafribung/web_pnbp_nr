<div>
    @livewire('penghulu.form')
    <x-navbar> Penghulu </x-navbar>
    <x-cta> Berisi daftar penghulu di Kabupaten Mamuju </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message>{{ session('message') }}</x-message>
            @endif
            <div class="flex justify-between mt-2">
                <x-search>
                    <x-input class="pl-8 pr-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                </x-search>
                <x-button-add wire:click="$emitTo('penghulu.form', 'create')"></x-button-add>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Gologan</th>
                        <th class="px-4 py-3">Jabatan</th>
                        <th class="px-4 py-3">KUA</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($penghulus as $penghulu)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ (($penghulus->currentPage() - 1 ) * $penghulus->perPage() ) + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm font-bold"> {{ $penghulu->name }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $penghulu->golongan->name }} </td>
                        <td class="px-4 py-3 text-sm"> {{ ($penghulu->kua_leader == 1) ? 'Kepala KUA' : 'Penghulu' }} </td>
                        <td class="px-4 py-3 text-sm"> {{ $penghulu->kua->name }} </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                @if ($penghulu->kua_leader == 1)
                                <x-button-edit-delete metode='image' wire:click="$emitTo('penghulu.form', 'edit', {{ $penghulu->id }})" class="hover:text-blue-700 text-blue-600 focus:shadow-outline-blue"></x-button-edit-delete>
                                @endif
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('penghulu.form', 'edit', {{ $penghulu->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('penghulu.form', 'delete', {{ $penghulu->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="5" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $penghulus->links() }}
    </div>

</div>
