<x-modal maxWidth="4xl" wire:model="modal">
    @if( empty($pernikahanIdDelete) )
    <form wire:submit.prevent="storeOrUpdate" class="space-y-8 divide-y divide-gray-200">
        <div class="space-y-6 divide-y divide-gray-200">
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Tambah Data Calon Pengantin
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Isi menggunakan data yang valid
                    </p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    {{-- <div class="sm:col-span-2">
                        <x-label for="registration_date" value="{{ __('Tgl Registrasi') }}" />
                        <div class="mt-1">
                            <x-input id="registration_date" wire:model.lazy="registration_date" type="date"
                                :value="old('registration_date')" />
                        </div>
                        @error('registration_date')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <x-label for="no_registrasi" value="{{ __('No Registrasi') }}" />
                        <div class="mt-1">
                            <x-input id="no_registrasi" wire:model.lazy="no_registrasi" type="text"
                                :value="old('no_registrasi')" />
                        </div>
                        @error('no_registrasi')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <x-label for="no_agenda_client" value="{{ __('No Agenda Klien') }}" />
                        <div class="mt-1">
                            <x-input id="no_agenda_client" wire:model.lazy="no_agenda_client" type="text"
                                :value="old('no_agenda_client')" />
                        </div>
                        @error('no_agenda_client')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    <div class="sm:col-span-3">
                        <x-label for="male" value="{{ __('Catim Pria') }}" />
                        <x-input id="male" class="block mt-1 w-full" type="text" wire:model="male" autofocus autocomplete="off"/>
                        <x-input-error for="male" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-label for="male_age" value="{{ __('Umur Pria') }}" />
                        <x-input id="male_age" class="block mt-1 w-full" type="number" wire:model="male_age" autocomplete="off"/>
                        <x-input-error for="male_age" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-label for="female" value="{{ __('Catim Wanita') }}" />
                        <x-input id="female" class="block mt-1 w-full" type="text" wire:model="female" autofocus autocomplete="off"/>
                        <x-input-error for="female" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-label for="female_age" value="{{ __('Umur Wanita') }}" />
                        <x-input id="female_age" class="block mt-1 w-full" type="number" wire:model="female_age" autocomplete="off"/>
                        <x-input-error for="female_age" class="mt-2"/>
                    </div>

                </div>
            </div>

            <div class="pt-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Tambah Data Detail Pernikahan
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Isi menggunakan data yang valid
                    </p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <x-label for="village_id" :value="__('Desa/Kelurahan')" />
                        <x-select wire:model="village_id" id="village_id">
                            @slot('option_default', 'Silahkan Pilih Tipologi')
                            @foreach($villages['kelurahan'] as $village)
                                <option>{{ $village['nama'] }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="village_id" class="mt-2"/>
                    </div>
                    <div class="sm:col-span-3">
                        <x-label for="courier_name" value="{{ __('Nama Kurir') }}" />
                        <div class="mt-1">
                            <x-input id="courier_name" wire:model.lazy="courier_name" type="text"
                                :value="old('courier_name')" />
                        </div>
                        @error('courier_name')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <x-label for="courier_phone" value="{{ __('No Telpon') }}" />
                        <div class="mt-1">
                            <x-input id="courier_phone" wire:model.lazy="courier_phone" type="text"
                                :value="old('courier_phone')" />
                        </div>
                        @error('courier_phone')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-6">
                        <x-label for="perihal" value="{{ __('Perihal') }}" />
                        <div class="mt-1">
                            <textarea wire:model.lazy="perihal" id="perihal" rows="3" class="control-input">
                                {{ old('perihal') }}
                            </textarea>
                        </div>
                        @error('perihal')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-6">
                        <x-label for="note_general" value="{{ __('Catatan Umum') }}" />
                        <div class="mt-1">
                            <textarea wire:model.lazy="note_general" id="note_general" rows="3" class="control-input">
                                {{ old('note_general') }}
                            </textarea>
                        </div>
                        @error('note_general')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-6">
                        <x-label for="note_lab" value="{{ __('Catatan Lab') }}" />
                        <div class="mt-1">
                            <textarea wire:model.lazy="note_lab" id="note_lab" rows="3" class="control-input">
                                {{ old('note_lab') }}
                            </textarea>
                        </div>
                        @error('note_lab')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
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
            class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
            Batal
        </x-button>
        <x-button wire:click="destroy"
            class="bg-red-600 active:bg-red-600 hover:bg-red-700 focus:shadow-outline-red">
            Hapus
        </x-button>
    </x-delete-card>
    @endif
</x-modal>
