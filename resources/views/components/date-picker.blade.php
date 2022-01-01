@props([
'error' => null
])

<div class="relative" x-data="{ value: @entangle($attributes->wire('model'))}" x-init="flatpickr($refs.input, {
        dateFormat: 'd/m/Y',
        mode: 'range',
        defaultDate: [value[0], value[1]],
        onChange: function(selectedDates, dateStr, instance) {

            if (selectedDates.length > 1) {
                const dates = dateStr.split(' - ');

                value = dates;
            }
        },
    })">

    <input {{ $attributes->whereDoesntStartWith('wire:model') }}
    x-ref="input"
    x-bind:value="value.join(' - ')"
    type="text"
    readonly
    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
    focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
    />
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </div>
</div>
