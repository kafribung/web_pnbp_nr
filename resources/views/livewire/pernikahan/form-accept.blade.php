<div>
    <x-modal maxWidth="xl" wire:model="modal">
        <form wire:submit.prevent="storeOrUpdate"  class="space-y-8 divide-y divide-gray-200" autocomplete="off">
            <div class="space-y-6 divide-y divide-gray-200">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        ACC data pernikahan pada bulan yang telah dipilih 
                    </h3>

                    <div class="mt-3">
                        <p>Apakah anda yakin semua data sudah benar ?</p>
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
                            ACC
                        </x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-modal>
</div>

