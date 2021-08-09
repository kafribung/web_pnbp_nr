<div>
    @livewire('staf-kua.form')
    <x-navbar> Staf KUA </x-navbar>
    <x-cta> Berisi data akun staf KUA di Kabupaten Mamuju </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message>{{ session('message') }}</x-message>
            @endif
            <div class="flex justify-between mt-2">
                <x-search>
                    <x-input class="pl-8 pr-2 text-sm text-black" wire:model="search" type="text" placeholder="Search"></x-input>
                </x-search>
                <x-button-add wire:click="$emitTo('staf-kua.form', 'create')"></x-button-add>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($stafKuas as $index => $stafKua)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ (($stafKuas->currentPage() - 1 ) * $stafKuas->perPage() ) + $loop->iteration }} </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ $stafKua->name }}&background=059669&color=fff&bold=true"
                                        alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $stafKua->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400"> Staf KUA {{ $stafKua->kua->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $stafKua->email }} </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('staf-kua.form', 'edit', {{ $stafKua->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('staf-kua.form', 'delete', {{ $stafKua->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td colspan="4" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $stafKuas->links() }}
    </div>
</div>
