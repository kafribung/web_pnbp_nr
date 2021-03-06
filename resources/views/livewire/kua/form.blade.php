<x-modal maxWidth="md" wire:model="modal">
    @if($kuaIdDelete == null)
    <form wire:submit.prevent="storeOrUpdate"  class="space-y-8 divide-y divide-gray-200" autocomplete="off">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ !empty($kuaId) ? "Ubah KUA" : "Tambah KUA"}}
                </h3>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="name" :value="__('Kua')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required autofocus />
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="typology_id" :value="__('Tipologi')" />
                        <x-select wire:model="typology_id" id="typology_id">
                            @slot('option_default', 'Silahkan Pilih Tipologi')
                            @foreach($typologies as $typology)
                                <option value="{{ $typology->id }}">{{ $typology->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="typology_id" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="px-4 py-2 mt-4 bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="px-4 py-2 mt-4 {{ !empty($kuaId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-green-400 active:bg-green-500 hover:bg-green-600 focus:shadow-outline-green'}}">
                        {{ !empty($kuaId) ? "Ubah" : "Simpan"}}
                    </x-button>
                </div>
            </div>
        </div>
    </form>
    @else
    <x-delete-card>
        <x-slot name="name">{{ $name }}</x-slot>
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
