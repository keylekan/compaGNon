@props(['message'])

@if ($message)
    <div {{ $attributes->merge(['class' => 'rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900']) }}>
        {{ $message }}
    </div>
@endif
