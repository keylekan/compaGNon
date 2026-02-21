@props([
    'status',
])

<?php
$variant = match ($status->value) {
    'confirmed', 'accepted' => 'good',
    'cancelled' => 'warn',
    'refused' => 'bad',
    default => null,
};
?>

<x-badge :variant="$variant" {{ $attributes }}>
    {{ $status->label() }}
</x-badge>
