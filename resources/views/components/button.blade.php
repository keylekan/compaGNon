@props([
  'variant' => 'primary', // primary | secondary | ghost | danger
  'size' => 'md', // sm | md | lg
  'type' => 'button',
  'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg
             font-semibold transition focus:outline-none
             focus-visible:ring-2 focus-visible:ring-bronze-400/60 cursor-pointer
             disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
      'primary' =>
        'bg-bronze-500 text-white hover:bg-bronze-600',
      'secondary' =>
        'border border-sand-200 bg-white text-sand-700 hover:bg-sand-50',
      'panel' =>
        'bg-sand-300' . (! $disabled ? ' hover:bg-sand-400' : ''),
      'ghost' =>
        'text-sand-700 hover:bg-sand-100',
      'danger' =>
        'bg-red-600 text-white hover:bg-red-500',
    ];

    $sizes = [
      'sm' => 'px-2 py-1 text-xs',
      'md' => 'px-4 py-2 text-sm',
      'lg' => 'px-6 py-3 text-md',
    ];
@endphp

<button
    type="{{ $type }}"
    @if($disabled) :disabled="{{$disabled}}" @endif
    {{ $attributes->class([$base, $variants[$variant] ?? $variants['primary'], $sizes[$size] ?? $sizes['md']]) }}
>
    {{ $slot }}
</button>
