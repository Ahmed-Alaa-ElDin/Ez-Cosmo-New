@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm font-bold text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
