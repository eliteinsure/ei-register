@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-dsgreen focus:ring focus:ring-lmara focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
  <option value="">-</option>
  @foreach ($options as $option)
    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
  @endforeach
</select>
