<section class="sheet padding-10mm">
    <!-- Write HTML just like a web page -->
    <article class="text-xs font-bold text-center uppercase">Data Peristiwa Nikah</article>
    <article class="text-xs font-bold text-center uppercase">Kantor Urusan Agama Kecamatan {{ $kua->name }}</article>
    <article class="text-xs font-bold text-center uppercase">Tahun {{ $currentYear }}</article>

    <div class="flex">
        <div class="flex flex-col">
            <div class="text-xs mt-2">Bulan : {{ $bulan }}</div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold text-left text-gray-500 border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-3 py-1">No</th>
                        <th class="px-3 py-1">Catin Pria</th>
                        <th class="px-3 py-1">Catin Wanita</th>
                        <th class="px-3 py-1">Desa / Kelurahan</th>
                        <th class="px-3 py-1">Nomor Akta</th>
                        <th class="px-3 py-1">Nomor Seri Porposisi</th>
                        <th class="px-3 py-1">Nama Penghulu</th>
                        <th class="px-3 py-1">Hari</th>
                        <th class="px-3 py-1">Tanggal</th>
                        <th class="px-3 py-1">Peristiwa Nikah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($pernikahans as $index => $pernikahan)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-3 text-xs">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-3">
                            <div class="flex items-center text-xs">
                                <div>
                                    <p class="font-semibold">{{ $pernikahan->male }} Bin {{ $pernikahan->male_father }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->male_age }} tahun</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-3">
                            <div class="flex items-center text-xs">
                                <div>
                                    <p class="font-semibold">{{ $pernikahan->female }} Binti {{ $pernikahan->female_father }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pernikahan->female_age }} tahun</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-3">
                            <div class="flex items-center text-xs">
                                <div>
                                    <p class="font-semibold"> {{ $pernikahan->desa->name }} </p>
                                    @if ($kua->name == 'Tommo' || $kua->name == 'Tapalang Barat' || $kua->name == 'Bonehau' || $kua->name == 'Kalumpang' || $kua->name == 'Kepulauan Balabalakang')
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ number_format($pernikahan->transport, 2) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-3 text-xs"> {{ $pernikahan->marriage_certificate_number }} </td>
                        <td class="px-3 text-xs"> {{ $pernikahan->perforation_number }} </td>
                        <td class="px-3 text-xs"> {{ $pernikahan->penghulu->name ?? null }} </td>
                        <td class="px-3 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('dddd')  }} </td>
                        <td class="px-3 text-xs"> {{  date('d M Y', strtotime($pernikahan->date_time)) }} </td>
                        {{-- <td class="px-3 text-xs"> {{ Carbon\Carbon::parse($pernikahan->date_time)->isoFormat('d MMM Y')  }} </td> --}}
                        <td class="px-3 text-xs font-semibold"> {{ $pernikahan->peristiwa_nikah->name ?? null }} </td>

                    </tr>
                    @empty
                        <td colspan="20" class="items-center text-center">Data tidak ditemukan !</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-end text-xs mt-2">
        <div class="flex-col">
            <p>{{ $kua->name }}, {{ $tanggalLengkap }}</p>
            <img width="100" src="{{ asset($kuaLeader->takeImg) }}" alt="TTD">
            <p class="mt-2">{{ $kuaLeader->name }}</p>
        </div>
    </div>

</section>
