@props([
    'href',
    'variant' => 'primary', // primary | secondary | panel | ghost | danger
    'size' => 'md', // sm | md | lg
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold transition cursor-pointer'
            . ($disabled
                ? ' opacity-50'
                : ' focus:outline-none focus-visible:ring-2 focus-visible:ring-bronze-400/60');

    $variants = [
      'primary' =>
        'bg-bronze-500 text-white' . (! $disabled ? ' hover:bg-bronze-600' : ''),
      'secondary' =>
        'border border-sand-200 bg-white text-sand-700' . (! $disabled ? ' hover:bg-sand-50' : ''),
      'panel' =>
        'bg-sand-100' . (! $disabled ? ' hover:bg-sand-200' : ''),
      'ghost' =>
        'text-sand-700' . (! $disabled ? ' hover:bg-sand-100' : ''),
      'danger' =>
        'bg-red-600 text-white' . (! $disabled ? ' hover:bg-red-700' : ''),
    ];

    $sizes = [
      'sm' => 'px-2 py-1 text-xs',
      'md' => 'px-4 py-2 text-sm',
      'lg' => 'px-8 py-4 text-md',
    ];
@endphp

<a
    role="button"
    @if(! $disabled) href="{{$href}}" @endif
    {{ $attributes->class([$base, $variants[$variant] ?? $variants['primary'], $sizes[$size] ?? $sizes['md']]) }}
>
    {{ $slot }}
</a>
