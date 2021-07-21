<x-modal maxWidth="2xl" wire:model="">
    <form wire:submit.prevent="storeTest" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Tambah Pengujian
                </h3>
                <div class="mt-3">
                    <label class="block text-sm">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </label>
                    <label class="block mt-4 text-sm">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </label>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <x-ui-button wire:click="openCloseModalTest" type="button"
                        class="bg-white border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500">
                        Batal
                    </x-ui-button>
                    <x-ui-button type="submit"
                        class="ml-3 text-white bg-brand-600 hover:bg-brand-700 focus:ring-brand-500">
                        Simpan
                    </x-ui-button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
