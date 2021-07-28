<x-modal maxWidth="md" wire:model="modal">
    @if($kuaIdDelete == null)
    {{-- {{ $kuaId != null ? "wire:submit.prevent=update" : "wire:submit.prevent=store" }} --}}
    <form wire:submit.prevent="storeOrUpdate"  class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ !empty($kuaId) ? "Ubah KUA" : "Tambah KUA"}}
                </h3>
                <div class="mt-3">
                    <label class="block text-sm">
                        <x-label for="name" :value="__('Kua')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" name="name" :value="old('name')" autofocus />
                        <x-input-error for="name" class="mt-2"/>
                    </label>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="{{ !empty($kuaId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-blue-600 active:bg-blue-600 hover:bg-blue-700 focus:shadow-outline-blue'}}">
                        {{ !empty($kuaId) ? "Ubah" : "Simpan"}}
                    </x-button>
                </div>
            </div>
        </div>
    </form>
    @else
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Hapus KUA
                </h3>
                <div class="mt-3">
                    <p>Data akan dihapus permanent?</p>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button wire:click="destroy"
                        class="bg-red-600 active:bg-red-600 hover:bg-red-700 focus:shadow-outline-red">
                        Hapus
                    </x-button>
                </div>
            </div>
        </div>
    @endif
</x-modal>
