@if( empty($pernikahanIdDelete) )
<x-modal  maxWidth='4xl'  wire:model="modal">
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

                    <div class="sm:col-span-2">
                        <x-label for="male" value="{{ __('Catim Pria') }}" />
                        <x-input id="male" class="block mt-1 w-full" type="text" wire:model="male" autofocus autocomplete="off"/>
                        <x-input-error for="male" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-2">
                        <x-label for="male_father" value="{{ __('Ayah Pria') }}" />
                        <x-input id="male_father" class="block mt-1 w-full" type="text" wire:model="male_father" autocomplete="off"/>
                        <x-input-error for="male_father" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-2">
                        <x-label for="male_age" value="{{ __('Umur Pria') }}" />
                        <x-input id="male_age" class="block mt-1 w-full" type="number" wire:model="male_age" autocomplete="off"/>
                        <x-input-error for="male_age" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-2">
                        <x-label for="female" value="{{ __('Catim Wanita') }}" />
                        <x-input id="female" class="block mt-1 w-full" type="text" wire:model="female" autofocus autocomplete="off"/>
                        <x-input-error for="female" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-2">
                        <x-label for="female_father" value="{{ __('Ayah Wanita') }}" />
                        <x-input id="female_father" class="block mt-1 w-full" type="text" wire:model="female_father" autocomplete="off"/>
                        <x-input-error for="female_father" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-2">
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
                    <!-- Desa Keluarahan  -->
                    <div class="sm:col-span-2">
                        <x-label for="desa_id" value="{{ __('Desa/Keluarahan') }}" />
                        <x-select wire:model="desa_id" id="desa_id">
                            @slot('option_default', 'Pilih Desa/Keluarahan')
                            @foreach($desas as $desa)
                                <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="desa_id" class="mt-2"/>
                    </div>

                    <!-- Peristiwa nikah  -->
                    <div class="sm:col-span-2">
                        <x-label for="peristiwa_nikah_id" value="{{ __('Peristiwa Nikah') }}" />
                        <x-select wire:model="peristiwa_nikah_id" id="peristiwa_nikah_id">
                            @slot('option_default', 'Pilih Peristiwa Nikah')
                            @foreach($peristiwaNikahs as $peristiwaNikah)
                                <option value="{{ $peristiwaNikah->id }}">{{ $peristiwaNikah->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="peristiwa_nikah_id" class="mt-2"/>
                    </div>

                    <!-- Penghulu  -->
                    <div class="sm:col-span-2">
                        <x-label for="penghulu_id" value="{{ __('Penghulu') }}" />
                        <x-select wire:model="penghulu_id" id="penghulu_id">
                            @slot('option_default', 'Pilih Penghulu')
                            @foreach($penghulus as $penghulu)
                                <option value="{{ $penghulu->id }}">{{ $penghulu->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="penghulu_id" class="mt-2"/>
                    </div>

                    @if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
                    <div class="sm:col-span-6">
                        <x-label for="transport" value="{{ __(auth()->user()->kua->name == 'Kepulauan Balabalakang' ? 'Estimasi biaya transport max:1.000.000' : 'Estimasi biaya transport max:750.000' ) }}" />
                        <x-input id="transport" class="block mt-1 w-full" type="number" wire:model="transport"/>
                        <x-input-error for="transport" class="mt-2"/>
                    </div>
                    @endif

                    <div class="sm:col-span-6">
                        <x-label for="date_time" value="{{ __('Tanggal dan Waktu Pernikahan') }}" />
                        <x-input id="date_time" class="block mt-1 w-full" type="datetime-local" wire:model="date_time"/>
                        <x-input-error for="date_time" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="pt-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Tambah Data Detail Surat Nikah
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Isi menggunakan data yang valid
                    </p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <x-label for="marriage_certificate_number" value="{{ __('Nomor Akta Nikah') }}" />
                        <x-input id="marriage_certificate_number" class="block mt-1 w-full" type="text" wire:model="marriage_certificate_number" placeholder="Cnt: xxx/xxx/x/xxxx" autocomplete="off"/>
                        <x-input-error for="marriage_certificate_number" class="mt-2"/>
                    </div>

                    <div class="sm:col-span-3">
                        <x-label for="perforation_number" value="{{ __('Nomor Seri Porporasi') }}" />
                        <x-input id="perforation_number" class="block mt-1 w-full" type="text" wire:model="perforation_number" placeholder="Cnt: ST xxxxxxxxx" autocomplete="off"/>
                        <x-input-error for="perforation_number" class="mt-2"/>
                    </div>

                </div>
            </div>
            <div class="pt-2">
                <div class="flex justify-end">
                    <x-button wire:click="closeModal" type="button"
                        class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
                        Batal
                    </x-button>

                    <x-button type="submit"
                        class="{{ !empty($pernikahanId) ? 'bg-yellow-600 active:bg-yellow-600 hover:bg-yellow-700 focus:shadow-outline-yellow' : 'bg-green-600 active:bg-green-600 hover:bg-green-700 focus:shadow-outline-green'}}">
                        {{ !empty($pernikahanId) ? "Ubah" : "Simpan"}}
                    </x-button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
@else
<x-modal  maxWidth='md'  wire:model="modal">
    <x-delete-card>
        <x-slot name="name">
            {{ $name ?? $male }}
        </x-slot>
        <x-button wire:click="closeModal" type="button"
            class="bg-gray-400 active:bg-gray-500 hover:bg-gray-600 focus:shadow-outline-gray mr-2">
            Batal
        </x-button>
        <x-button wire:click="destroy"
            class="bg-red-600 active:bg-red-600 hover:bg-red-700 focus:shadow-outline-red">
            Hapus
        </x-button>
    </x-delete-card>
</x-modal>

@endif
