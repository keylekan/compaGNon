@props([
    'status',
])

<?php
$variant = match ($status->value) {
    'paid' => 'good',
    'unpaid' => 'bad',
    'refunded' => 'warn',
    default => null,
};
?>

<x-badge :variant="$variant" {{ $attributes }}>
    {{ $status->label() }}
</x-badge>
