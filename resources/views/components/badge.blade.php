@props([
  'variant', // good | warn | bad
  'size' => 'md', // sm | md | lg
])

<?php
    $baseClass = 'inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium';
    $variantClass = match ($variant) {
        'good' => 'border-teal-200 bg-teal-50 text-teal-800',
        'warn' => 'border-bronze-200 bg-bronze-50 text-bronze-900',
        'bad'  => 'border-error bg-red-100 text-error',
        default => 'border-sand-200 bg-sand-50 text-sand-700',
    };
?>

<span {{$attributes->class([$baseClass, $variantClass])}}>
    {{ $slot }}
</span>
