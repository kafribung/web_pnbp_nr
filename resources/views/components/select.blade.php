{{-- block mt-1 w-full rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray focus:ring focus:ring-green-200 focus:ring-opacity-50 --}}
<select {{ $attributes->merge(['class' => 'focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm text-gray-700 border-gray-300 rounded-md']) }}>
    <option value="">{{ $option_default }}</option>
    {{ $slot }}
</select>
