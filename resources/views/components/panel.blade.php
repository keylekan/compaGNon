@props([
    'main' => false,
])

<section {{ $attributes->class(['rounded-2xl border p-6', $main ? 'bg-bronze-50 border-bronze-200' : 'bg-white border-sand-300']) }}>
    {{$slot}}
</section>
