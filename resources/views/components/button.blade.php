<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-sm font-medium leading-5 shadow-md text-center text-white transition-colors duration-150  border border-transparent rounded-lg focus:outline-none']) }}>
    {{ $slot }}
</button>

