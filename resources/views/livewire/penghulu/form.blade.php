<x-modal maxWidth="md" wire:model="modal">
    @if( empty($penghuluIdDelete) )
    <form wire:submit.prevent="storeOrUpdate" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ !empty($penghuluId) ? "Ubah Penghulu" : "Tambah Penghulu"}}
                </h3>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="name" :value="__('Nama')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" autofocus autocomplete="off"/>
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="golongan_id" :value="__('Golongan')" />
                        <x-select wire:model="golongan_id" id="golongan_id">
                            @slot('option_default', 'Silahkan Pilih Golongan')
                            @foreach($golongans as $golongan)
                                <option value="{{ $golongan->id }}">{{ $golongan->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="golongan_id" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="kua_id" :value="__('Kua')" />
                        <x-select wire:model="kua_id" id="kua_id">
                            @slot('option_default', 'Silahkan Pilih KUA')
                            @foreach($kuas as $kua)
                                <option value="{{ $kua->id }}">{{ $kua->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="kua_id" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="kua_leader" :value="__('Profesi Utama')" />
                        <input id="kua_leader" class="" type="checkbox" wire:model="kua_leader" autofocus autocomplete="off"/>
                        <x-label class="inline-block ml-1 mt-1s" for="kua_leader" :value="__('Kepala KUA')" />
                        <x-input-error for="kua_leader" class="mt-2"/>
                    </div>
                </div>

                @if ($kua_leader)
                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="ttd_digital" :value="__('Tanda tangan')" />
                        <x-input id="ttd_digital" class="block mt-1 w-full" type="file" accept="image/jpeg" wire:model="ttd_digital" autofocus autocomplete="off"/>
                        <x-input-error for="ttd_digital" class="mt-2"/>

                        <div wire:loading wire:target="ttd_digital">Uploading...</div>
                        @if ($ttd_digital)
                            Photo Preview:
                            <img src="{{ $ttd_digital->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
                @endif

            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="px-4 py-2 mt-4 bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="px-4 py-2 mt-4 {{ !empty($penghuluId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-green-600 active:bg-green-600 hover:bg-green-700 focus:shadow-outline-green'}}">
                        {{ !empty($penghuluId) ? "Ubah" : "Simpan"}}
                    </x-button>
                </div>
            </div>
        </div>
    </form>

    @else
    <x-delete-card>
        @slot('name')
            {{ $name }}
        @endslot
        <x-button wire:click="closeModal" type="button"
            class="px-4 py-2 mt-4 bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
            Batal
        </x-button>
        <x-button wire:click="destroy"
            class="px-4 py-2 mt-4 bg-red-600 active:bg-red-600 hover:bg-red-700 focus:shadow-outline-red">
            Hapus
        </x-button>
    </x-delete-card>
    @endif
</x-modal>
