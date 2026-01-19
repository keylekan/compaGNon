@props([
    'status',
])

<?php
$variant = match ($status->value) {
    'confirmed', 'linked' => 'good',
    'cancelled' => 'warn',
    default => null,
};
?>

<x-badge :variant="$variant" {{ $attributes }}>
    {{ $status->label() }}
</x-badge>
