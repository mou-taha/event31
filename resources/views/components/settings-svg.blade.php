@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-teal-500 group-hover:text-teal-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0'
            : 'text-gray-400 group-hover:text-gray-500 -ml-1 mr-3 h-6 w-6 flex-shrink-0';
@endphp 

<svg {{ $attributes->merge(['class' => $classes]) }} fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
    {{ $slot }}
</svg>