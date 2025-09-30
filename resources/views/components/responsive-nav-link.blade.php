@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-emerald-800 text-white group flex items-center rounded-md px-2 py-2 text-base font-medium focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'text-emerald-100  hover:bg-emerald-600 hover:text-white group flex items-center rounded-md px-2 py-2 text-base font-medium hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp
 
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
  