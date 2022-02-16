<aside x-data="{ isPagesMenuOpen: false }"
    class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <div class="ml-6">
            <img aria-hidden="true" class="object-cover w-20 inline-block" src="{{ asset('assets/img/logo.png') }}" width="80" alt="Logo" />
            <a class="text-lg font-bold  text-gray-800 dark:text-gray-200" href="/">
                SI PNBP-NR
            </a>
        </div>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->routeIs('dashboard'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('dashboard') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('dashboard') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            {{-- Admin --}}
            @if(auth()->user()->hasRole('admin'))
            <li class="relative px-6 py-3">
                @if (request()->routeIs('kua'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('kua') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('kua') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <span class="ml-4">KUA</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->routeIs('staf-kua'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('staf-kua') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('staf-kua') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'
                    </svg>
                    <span class="ml-4">Staf KUA</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->routeIs('penghulu'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('penghulu') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('penghulu') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="ml-4">Penghulu</span>
                </a>
            </li>
            @endif

            <li class="relative px-6 py-3">
                @if (request()->routeIs('pernikahan'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('pernikahan') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('pernikahan') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span class="ml-4">Pernikahan</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->routeIs('jasa-profesi-dan-transport'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('jasa-profesi-dan-transport') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('jasa-profesi-dan-transport') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="ml-4">Jasa Profesi dan Transport</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->routeIs('rekap-pnbp-nr'))
                <span class="absolute inset-y-0 left-0 w-1 bg-green-400 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold {{ request()->routeIs('rekap-pnbp-nr') ? 'text-gray-900' : '' }} transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    href="{{ route('rekap-pnbp-nr') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <span class="ml-4">Rekap PNBP NR</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    x-on:click="isPagesMenuOpen = ! isPagesMenuOpen" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                        <span class="ml-4">Pages</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="pages/login.html">Login</a>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="pages/create-account.html">
                                Create account
                            </a>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="pages/forgot-password.html">
                                Forgot password
                            </a>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="pages/404.html">404</a>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="pages/blank.html">Blank</a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</aside>
