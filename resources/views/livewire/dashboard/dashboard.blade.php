<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Dashboard </h2>
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Total clients </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 6389 </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Account balance
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> $ 46,760.89 </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> New sales </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 376 </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Pending contacts
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 37 </p>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center min-w-0 p-4 text-white bg-green-400 rounded-lg shadow-xs">
        <h4 class="mb-2 text-2xl font-semibold">
            Assalamualaikum warahmatullahi wabarakatuh
        </h4>
        @if ( auth()->user()->hasRole('admin') )
        <h4 class="text-xl font-semibold">
            Selamat datang admin {{ auth()->user()->name }}
        </h4>
        <p class="mt-2 text-base">
            Sistem Informasi Pelaporan PNBP-NR Kementrian Agama Kabupaten Mamuju
        </p>
        @else
        <h4 class="text-xl font-semibold">
            Selamat datang staf KUA {{ auth()->user()->name }}
        </h4>
        <p class="mt-2 text-base">
            Sistem Informasi Pelaporan PNBP-NR Kantor KUA Kecamatan {{ auth()->user()->kua->name }}, Kabupaten Mamuju, Provinsi Sulawesi Barat
        </p>
        @endif
        <p class="text-base">
            "Ikhlas Beramal"
        </p>
    </div>

    <!-- Charts -->
    {{-- <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Charts </h2>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300"> Revenue </h4>
                <canvas id="pie"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    <!-- Chart legend -->
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                        <span>Shirts</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                        <span>Shoes</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                        <span>Bags</span>
                    </div>
                </div>
            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Traffic
                </h4>
                <canvas id="line"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    <!-- Chart legend -->
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                        <span>Organic</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                        <span>Paid</span>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="mt-6">
            <div class="flex justify-start">
                <div class="ml-1">
                    <x-select class="text-sm" wire:model="currnetMonth">
                        @slot('option_default', 'Filter Bulan')
                        @php
                            $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                        @endphp
                        @for ($i = 0; $i < count($month); $i++)
                        <option value="{{ $i + 1 }}">{{ $month[$i] }}</option>
                        @endfor
                    </x-select>
                </div>
            </div>
        </div>
        <div class="w-full my-6 overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" rowspan="3">No</th>
                            <th class="px-4 py-3" rowspan="3">Kelurahan/Desa</th>
                            <th class="px-4 py-3" rowspan="3">Luar Kantor</th>
                            <th class="px-4 py-3 text-center" colspan="4">Bebas Biaya</th>
                            <th class="px-4 py-3" rowspan="3">Jml NR</th>
                            <th class="px-4 py-3" rowspan="3">Total PNBP</th>
                            <th class="px-4 py-3 text-center" colspan="6">Berdasarkan Usia</th>
                        </tr>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" rowspan="2">Kantor</th>
                            <th class="px-4 py-3" rowspan="2">Miskin</th>
                            <th class="px-4 py-3" rowspan="2">Bencana Alam</th>
                            <th class="px-4 py-3" rowspan="2">Isbat</th>

                            <th class="px-4 py-3" colspan="2">Di Bawah 19 Thn</th>
                            <th class="px-4 py-3" colspan="2">19 s.d 21 Thn</th>
                            <th class="px-4 py-3" colspan="2">Di Atas 21 Thn</th>
                        </tr>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Pria</th>
                            <th class="px-4 py-3">Wanita</th>

                            <th class="px-4 py-3">Pria</th>
                            <th class="px-4 py-3">Wanita</th>

                            <th class="px-4 py-3">Pria</th>
                            <th class="px-4 py-3">Wanita</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr class="text-center text-xs font-bold">
                            <td>a</td>
                            <td>b</td>
                            <td>c</td>
                            <td>d</td>
                            <td>e</td>
                            <td>f</td>
                            <td>g</td>
                            <td>h=(c+d+e+f+g)</td>
                            <td>i=(c*Rp.600.000.00)</td>
                            <td>j</td>
                            <td>k</td>
                            <td>l</td>
                            <td>m</td>
                            <td>n</td>
                            <td>o</td>
                        </tr>
                        @php
                            $angkaAwal = 1;
                        @endphp
                        @forelse ($pernikahans->unique('desa_id') as $index => $pernikahan)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-xs text-center">{{ $angkaAwal++ }}</td>
                                <td class="px-4 py-3 text-xs">{{ $pernikahan->desa->name }}</td>
                                {{-- Luar Kantor --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Kantor/Balai Nikah --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Balai Nikah'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Miskin --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Kurang Mampu'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Bencana Alam --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Bencana Alam'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Isbat --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Isbat'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>

                                {{-- Jumlah NR --}}
                                <td class="px-4 py-3 text-xs text-center">{{$jumlahNr = $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>

                                {{-- Total PNBP --}}
                                <td class="px-4 py-3 text-xs text-center">{{ number_format($jumlahNr * 600000, 2) }}</td>

                                {{-- Di bawah 19 tahun --}}
                                {{-- Pria --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('male_age', '<', 19)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Wanita --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('female_age', '<', 19)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>

                                {{-- 19-21 tahun --}}
                                {{-- Pria --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('male_age', '>=', 19)->where('male_age', '<=', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Wanita --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('female_age', '>=', 19)->where('female_age', '<=', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>

                                {{-- Di atas 21 tahun --}}
                                {{-- Pria --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('male_age', '>', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>
                                {{-- Wanita --}}
                                <td class="px-4 py-3 text-xs text-center">{{ $pernikahan->whereHas('desa', fn($query) => $query->where('name', $pernikahan->desa->name))->where('female_age', '>', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->count() }}</td>

                            </tr>
                        @empty
                        <tr>
                            <td colspan="20" class="px-4 py-3 text-base font-bold justify-center text-center">Data pernikahan di bulan {{ $currnetMonth }} tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

</div>
