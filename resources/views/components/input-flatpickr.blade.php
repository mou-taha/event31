<input
    {{ $disabled ? 'disabled' : '' }}
    x-data
    x-init="flatpickr($el, {mode: 'single',
    dateFormat: 'Y-m-d',})"
    {!! $attributes->merge(['type' => 'text', 'class' => 'mt-2 block w-full rounded-md border-0 px-3 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:border-0 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6']) !!}
/> 
 