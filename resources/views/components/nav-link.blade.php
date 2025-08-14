@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-500 text-sm font-medium leading-5 text-red-400 focus:outline-none focus:border-red-600 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-red-500 hover:border-red-500/50 focus:outline-none focus:text-red-500 focus:border-red-500/50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
