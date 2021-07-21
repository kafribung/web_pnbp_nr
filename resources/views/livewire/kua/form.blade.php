<x-modal maxWidth="md" wire:model="modal">
    <form wire:submit.prevent="store" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Tambah KUA
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
                    <x-button wire:click="openCloseModal" type="button"
                        class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="bg-green-600 active:bg-green-600 hover:bg-green-700 focus:shadow-outline-green">
                        Simpan
                    </x-button>

                </div>
            </div>
        </div>
    </form>
</x-modal>
