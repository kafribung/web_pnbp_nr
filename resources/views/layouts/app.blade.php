<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

    <title>{{ auth()->user()->kua ? 'KUA Kecamatan ' . auth()->user()->kua->name : 'BIMAS Islam Kabupaten Mamuju'  }} </title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">




    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @stack('mycss')
    @livewireStyles
</head>

<body>
    <div x-data="{ isSideMenuOpen : false}" class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('layouts._sidebar')
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        @include('layouts._mobile-sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts._header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @livewireScripts
    <script>
        console.log(localStorage.getItem('thema'));
    </script>
</body>

</html>
