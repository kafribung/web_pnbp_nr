<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Dashboard </h2>
    @if (session('message'))
        <x-message type="message">{{ session('message') }}</x-message>
    @endif
    <!-- Cards -->
    @if (auth()->user()->kua)
        @include('livewire.dashboard._cards-kua')
    @else
        @include('livewire.dashboard._cards-bimas')
    @endif


    <div class="flex flex-col items-center justify-center min-w-0 p-4 text-white bg-green-400 rounded-lg shadow-xs">
        <h4 class="mb-2 text-2xl font-semibold">
            Assalamualaikum warahmatullahi wabarakatuh
        </h4>
        @if ( auth()->user()->hasRole('admin') )
        <h4 class="text-xl font-semibold">
            Selamat datang admin {{ auth()->user()->name }}
        </h4>
        <p class="mt-2 text-base">
            Di Sistem Informasi Pelaporan PNBP-NR Kementrian Agama Kabupaten Mamuju
        </p>
        @else
        <h4 class="text-xl font-semibold">
            Selamat datang staf KUA {{ auth()->user()->name }}
        </h4>
        <p class="mt-2 text-base">
            Di Sistem Informasi Pelaporan PNBP-NR Kantor KUA Kecamatan {{ auth()->user()->kua->name }}, Kabupaten
            Mamuju, Provinsi Sulawesi Barat
        </p>
        @endif
        <p class="text-base">
            "Ikhlas Beramal"
        </p>
    </div>

    @if (auth()->user()->kua)
        @include('livewire.dashboard._table-kua')
    @else
        @include('livewire.dashboard._table-bimas')
    @endif

</div>
