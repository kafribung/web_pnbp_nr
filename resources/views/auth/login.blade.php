<x-guest-layout>
    <x-auth-card-login>
        <x-slot name="logo">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            <div class="flex flex-col items-center justify-center mt-2 max-w-xs text-gray-700 dark:text-gray-200">
                <div class="text-2xl font-bold">Seksi BIMAS Islam</div>
                <div class="text-sm md:text-base font-semibold">Kementrian Agama Kabupaten Mamuju</div>
                <div class="text-xs md:text-sm"> Jl. KS Tubun No.70 Mamuju</div>
            </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" >
            @csrf
            <h1 class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200"> Login </h1>
            <!-- Email Address -->
            <label class="block text-sm">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </label>
            <label class="block mt-4 text-sm">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </label>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <x-button-block class="bg-green-600 active:bg-green-600 hover:bg-green-700 focus:shadow-outline-green"> {{ __('Log in') }} </x-button-block>
        </form>

    </x-auth-card-login>
</x-guest-layout>
