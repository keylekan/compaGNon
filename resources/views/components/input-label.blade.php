@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-sand-700']) }}>
    {{ $value ?? $slot }}
</label>
