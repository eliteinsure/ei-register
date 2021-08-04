@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-dsgreen focus:ring focus:ring-lmara focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
