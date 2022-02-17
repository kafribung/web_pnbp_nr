<div>
    <x-modal maxWidth="xl" wire:model="modal">
        <form wire:submit.prevent="repair"  class="space-y-8 divide-y divide-gray-200" autocomplete="off">
            <div class="space-y-6 divide-y divide-gray-200">
                <div>
                    @if ($show)
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Perbaikan data pernikahan, berikan catatan
                    </h3>
                    @endif
                    <div class="mt-3">
                        <div class="block text-sm">
                            <x-label for="note" :value="__('Catatan')" />
                            <textarea wire:model="note"  {{ !$show ? 'disabled' : '' }} class="block mt-1 w-full border-red-800" id="note" placeholder="Cnt: Terdapat kekeliruan jumlah transportasi seharusnya ..."></textarea>
                            <x-input-error for="note" class="mt-2"/>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <x-button wire:click="closeModal" type="button"
                            class="px-4 py-2 mt-4 bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                            Batal
                        </x-button>

                        @if ($show)
                        <x-button type="submit"
                            class="px-4 py-2 mt-4 bg-red-400 active:bg-red-500 hover:bg-red-600 focus:shadow-outline-red">
                            Repair
                        </x-button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </x-modal>
</div>

