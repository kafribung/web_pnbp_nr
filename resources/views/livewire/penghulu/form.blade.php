<x-modal maxWidth="md" wire:model="modal">
    <form wire:submit.prevent="storeOrUpdate" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ !empty($penghuluId) ? "Ubah Penghulu" : "Tambah Penghulu"}}
                </h3>
                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="name" :value="__('Nama')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" autofocus />
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="golonganId" :value="__('Golongan')" />
                        <select wire:model="golonganId" id="golonganId" class="block mt-1 w-full rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <option value="">Silahkan Pilih Golongan</option>
                            @foreach($golongans as $golongan)
                                <option value="{{ $golongan->id }}">{{ $golongan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="golonganId" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="kuaId" :value="__('Kua')" />
                        <select wire:model="kuaId" id="kuaId" class="block mt-1 w-full rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            <option value="">Silahkan Pilih KUA</option>
                            @foreach($kuas as $kua)
                                <option value="{{ $kua->id }}">{{ $kua->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="kuaId" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="{{ !empty($penghuluId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-blue-600 active:bg-blue-600 hover:bg-blue-700 focus:shadow-outline-blue'}}">
                        {{ !empty($penghuluId) ? "Ubah" : "Simpan"}}
                    </x-button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
