@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm text-gray-700 border-gray-300 rounded-md']) !!}>
