@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:text-gray-300 dark:focus:shadow-outline-gray focus:ring focus:ring-green-200 focus:ring-opacity-50']) !!}>
