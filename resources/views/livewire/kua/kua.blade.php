<div>
    @livewire('kua.form')
    <x-navbar> KUA </x-navbar>
    <x-cta> Berisi daftar kantor KUA di Kabupaten Mamuju </x-cta>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('message'))
            <x-message>{{ session('message') }}</x-message>
            @endif
            <div class="flex justify-between mt-2">
                <div class="relative ml-2 focus-within:text-green-500">
                    <div class="absolute inset-y-0 flex items-center pl-2">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-input class="pl-8 pr-2 text-sm" name="search" type="text" placeholder="Search"></x-input>
                </div>
                <x-button-add wire:click="$emitTo('kua.form', 'create')"></x-button-add>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kua</th>
                        <th class="px-4 py-3">Tipologi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($kuas as $kua)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{ (($kuas->currentPage() - 1 ) * $kuas->perPage() ) + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $kua->name }} </td>
                        <td class="px-4 py-3 text-sm"> C </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-button-edit-delete metode='edit' wire:click="$emitTo('kua.form', 'edit', {{ $kua->id }})" class="hover:text-yellow-700 text-yellow-600 focus:shadow-outline-yellow"></x-button-edit-delete>
                                <x-button-edit-delete metode='delete' wire:click="$emitTo('kua.form', 'delete', {{ $kua->id }})" class="hover:text-red-700 text-red-600 focus:shadow-outline-red"></x-button-edit-delete>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $kuas->links() }}
    </div>
</div>
