@props(['active'])

@php
$classes = ($active ?? false)
            ? 'border-teal-500 bg-teal-50 text-teal-700 hover:bg-teal-50 hover:text-teal-700 group flex items-center border-l-4 px-3 py-2 text-sm font-medium'
            : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group flex items-center border-l-4 px-3 py-2 text-sm font-medium';
@endphp 

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
