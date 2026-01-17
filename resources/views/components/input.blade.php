@props([
    'name',
    'type' => 'text',
    'variant' => 'default', // important | default
    'label' => null,
    'disabled' => false,
    'full' => false,
])

@php
    $base = 'px-4 py-2.5 rounded-xl';

    $variants = [
      'important' =>
        'border-2 border-sand-500 bg-bronze-100 focus:outline focus:outline-sand-700 focus:border-sand-700 shadow-sm',
      'default' =>
        'border border-bronze-100 bg-white focus:outline-none focus:ring-2 focus:ring-bronze-400/50',
    ];
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-sand-900">
            {{ $label }}
        </label>
    @endif

    <input
        name="{{ $name }}"
        type="{{ $type }}"
        @disabled($disabled)
        {{ $attributes->class([$base, $variants[$variant] ?? $variants['primary'], 'w-full' => $full]) }}
    >

    @error($name)
    <p class="text-sm text-bronze-800">{{ $message }}</p>
    @enderror
</div>
