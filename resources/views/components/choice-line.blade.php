@props([
  'name',
  'value',
  'title',
  'description',
  'image' => null,
  'disabled' => 'false',
  'model' => null,
])

<label
    @if($disabled) aria-disabled="true" @endif
>
    <input
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        class="sr-only"
        @if($disabled) x-bind:disabled="{{ $disabled }}" @endif
        @if($model) x-model="{{ $model }}" @endif
    >

    <div
        class="flex items-start gap-3 p-4 w-full text-left rounded-xl border bg-sand-50/70 overflow-hidden transition
           hover:-translate-y-0.5 hover:shadow-sm focus-within:ring-2 focus-within:ring-bronze-400/50"
        :class="[
            {{ $model }} == {{ $value }} ? 'border-gold-500 ring-1 ring-gold-500/30' : 'border-sand-200',
            ({{ $disabled }}) ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
        ]"
    >
        <div class="shrink-0">
            <img
                class="h-12 w-12 rounded-md border border-black/10 object-cover"
                src="{{ $image }}"
                alt="{{ $title }}"
                loading="lazy"
            >
        </div>

        <div class="min-w-0">
            <div class="flex items-center justify-between gap-2">
                <h3 class="font-semibold text-sand-900">{{ $title }}</h3>
                <span
                    class="shrink-0 inline-flex items-center rounded-full border border-gold-500/60 bg-gold-500/10 px-2 py-0.5 text-xs font-semibold text-gold-700"
                    x-show="{{ $model ? $model : 'null' }} == {{ json_encode((string)$value) }}"
                    x-cloak
                >
                    Choisi
                </span>
            </div>

            <p class="mt-1 text-sm opacity-80 line-clamp-2">{{ $description }}</p>

            <div class="mt-3 flex items-center gap-2">
                {{ $slot }}

                <span class="text-xs text-sand-700">
                    Cliquer pour choisir
                </span>
            </div>
        </div>
    </div>
</label>
