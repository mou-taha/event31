@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-emerald-600 text-white rounded-md px-3 py-2 text-sm font-medium'
            : 'text-gray-500 hover:text-gray-700 rounded-md px-3 py-2 text-sm font-medium';
@endphp 

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
