@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-gray-900 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10'
            : 'text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-center text-sm font-medium hover:bg-gray-50 focus:z-10';
$classess = ($active ?? false)
            ? 'bg-emerald-500 absolute inset-x-0 bottom-0 h-0.5'
            : 'bg-transparent absolute inset-x-0 bottom-0 h-0.5';
@endphp 

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
    <span {{ $attributes->merge(['class' => $classess]) }}></span>
</a>
