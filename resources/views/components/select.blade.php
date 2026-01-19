@props([
    'name',
    'label' => null,
    'disabled' => false,
])

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
        {{ $attributes->merge([
            'class' =>
                'px-4 py-2.5 rounded-xl w-full border border-bronze-100 bg-white focus:outline-none focus:ring-2 focus:ring-bronze-400/50
                 disabled:bg-sand-100 disabled:text-sand-500 disabled:cursor-not-allowed',
        ]) }}
    >
        {{ $slot }}
    </select>

    @error($name)
    <p class="text-sm text-bronze-800">{{ $message }}</p>
    @enderror
</div>
