<x-modal maxWidth="md" wire:model="modal">
    @if( empty($stafIdDelete) )
    <form wire:submit.prevent="storeOrUpdate"  class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ !empty($stafId) ? "Ubah Staf" : "Tambah Staf"}}
                </h3>
                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="name" :value="__('Nama')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" autocomplete="off" required autofocus />
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email" autocomplete="off" required />
                        <x-input-error for="email" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" />
                        <x-input-error for="password" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" wire:model="password_confirmation" />
                        <x-input-error for="password_confirmation" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="block text-sm">
                        <x-label for="kua_id" :value="__('KUA')" />
                        <x-select wire:model="kua_id" id="kua_id">
                            @slot('option_default', 'Silahkan Pilih KUA')
                            @foreach($kuas as $kua)
                                <option value="{{ $kua->id }}">{{ $kua->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="kua_id" class="mt-2"/>
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
                        class="px-4 py-2 mt-4 {{ !empty($stafId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-green-600 active:bg-green-600 hover:bg-green-700 focus:shadow-outline-green'}}">
                        {{ !empty($stafId) ? "Ubah" : "Simpan"}}
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
