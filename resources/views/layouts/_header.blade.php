<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-green-400 dark:text-green-300">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-green"
            @click="isSideMenuOpen = !isSideMenuOpen" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div> </div>
        <div class="text-base font-bold animate-pulse" >
            <marquee width="100%" direction="left">
                Hi {{ auth()->user()->name }} {{ auth()->user()->hasRole('admin') ? 'sebagai staf KEMENAG' : 'sebagai staf KUA ' . auth()->user()->kua->name }}, selamat datang di sistem informasi pelaporan PNBP-NR Kabupaten Mamuju.
                Semangat bekerja dan Sehat selalu.
            </marquee>
        </div>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Theme toggler -->
            {{-- <li class="flex">
                <button class="rounded-md focus:outline-none focus:shadow-outline-green"
                x-data="{
                    dark: false,
                    toggleTheme: () => {
                        if (localStorage.thema == 'dark') {
                            localStorage.thema = 'light';
                            document.documentElement.classList.remove('dark');
                            dark = false;

                            } else {
                                localStorage.thema = 'dark';
                                dark = true;
                                document.documentElement.classList.add('dark');
                            }
                        },
                    }"

                    @click="toggleTheme" aria-label="Toggle color mode">
                    <template x-if="!dark">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                            </path>
                        </svg>
                    </template>
                    <template x-if="dark">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </template>
                </button>
            </li> --}}
            <!-- Notifications menu -->
            <li x-data="{ toggleNotificationsMenu : false }" class="relative">
                <button
                    class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-green"
                    @click="toggleNotificationsMenu = ! toggleNotificationsMenu"
                    @keydown.escape="toggleNotificationsMenu = false" aria-label="Notifications"
                    aria-haspopup="true">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                        </path>
                    </svg>
                    <!-- Notification badge -->
                    <span aria-hidden="true"
                        class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                </button>
                <template x-if="toggleNotificationsMenu">
                    <ul x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @click.away="toggleNotificationsMenu = false"
                        @keydown.escape="toggleNotificationsMenu = false"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Messages</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                    13
                                </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Sales</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                    2
                                </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <span>Alerts</span>
                            </a>
                        </li>
                    </ul>
                </template>
            </li>
            <!-- Profile menu -->
            <li x-data="{ toggleProfileMenu : false }" class="relative">
                <button class="align-middle rounded-full focus:shadow-outline-green focus:outline-none"
                    @click="toggleProfileMenu = ! toggleProfileMenu"
                    @keydown.escape="toggleProfileMenu =  false" aria-label="Account" aria-haspopup="true">
                    <img class="object-cover w-8 h-8 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=34D399&color=fff&bold=true"
                        alt="" aria-hidden="true" />
                </button>
                <template x-if="toggleProfileMenu">
                    <ul x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        @click.away="toggleProfileMenu = false" @keydown.escape="toggleProfileMenu = false"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                        aria-label="submenu">
                        <li class="flex">
                            <a href="profil" class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                >
                                <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a  href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="#">
                                <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span>Log out</span>
                            </a>
                            <form  method="POST" id="logout" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</header>
