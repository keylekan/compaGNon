@props([
    'name',
    'label' => null,
    'disabled' => false,
    'size' => 'md', // sm | md | lg
])

@php
    $base = 'rounded-lg w-full border border-bronze-100 bg-white focus:outline-none focus:ring-2 focus:ring-bronze-400/50
         disabled:bg-sand-100 disabled:text-sand-500 disabled:cursor-not-allowed';

    $sizes = [
      'sm' => 'px-2 py-1 text-sm',
      'md' => 'px-4 py-2 text-md',
      'lg' => 'px-6 py-3 text-lg',
    ];
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-sand-900">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @disabled($disabled)
        {{ $attributes->class([$base, $sizes[$size] ?? $sizes['md']]) }}
    >
        {{ $slot }}
    </select>

    @error($name)
    <p class="text-sm text-bronze-800">{{ $message }}</p>
    @enderror
</div>
