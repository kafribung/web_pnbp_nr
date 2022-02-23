<div>
    <x-navbar>
        <a href="{{ route('profil') }}" class="font-bold">Profil</a>
    </x-navbar>
    <x-cta> Informasi Staf KUA {{ auth()->user()->kua->name ?? '' }} </x-cta>

    <x-modal maxWidth="md">
        <form wire:submit.prevent="update"  class="space-y-8 divide-y divide-gray-200" autocomplete="off">
            <div class="space-y-6 divide-y divide-gray-200">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Ubah Profil
                    </h3>

                    <div class="mt-3">
                        <div class="block text-sm">
                            <x-label for="name" :value="__('Nama Lengkap')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required autofocus />
                            <x-input-error for="name" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="block text-sm">
                            <x-label for="password_old" :value="__('Password Lama')" />
                            <x-input id="password_old" class="block mt-1 w-full" type="password" wire:model="password_old" />
                            <x-input-error for="password_old" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="block text-sm">
                            <x-label for="password" :value="__('Password Baru')" />
                            <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" />
                            <x-input-error for="password" class="mt-2"/>
                        </div>
                    </div>


                    <div class="mt-3">
                        <div class="block text-sm">
                            <x-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" wire:model="password_confirmation" />
                            <x-input-error for="password_confirmation" class="mt-2"/>
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
                            class="px-4 py-2 mt-4 bg-green-400 active:bg-green-500 hover:bg-green-600 focus:shadow-outline-green">
                            Simpan
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-modal>

</div>

