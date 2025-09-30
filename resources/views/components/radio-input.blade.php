
@props(['disabled' => false, 'value'])


 
    <div>
      <input type="radio" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-600']) !!} value="{{ $value }}">
    </div> 

