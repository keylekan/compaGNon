@props([
  'name',
  'value',
  'title',
  'image' => null,
  'requirements' => null,
  'disabled' => 'false',
  'model' => null,
])

<label
    class="block"
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
        class="group w-full text-left rounded-xl border bg-sand-50/70 overflow-hidden transition
           hover:-translate-y-0.5 hover:shadow-sm focus-within:ring-2 focus-within:ring-bronze-400/50"
        :class="[
            {{ $model }} == {{ $value }} ? 'border-gold-500 ring-1 ring-gold-500/30' : 'border-sand-200',
            {{ $disabled }} ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
        ]"
    >
        <div class="aspect-[4/3] bg-sand-100 overflow-hidden">
            @if($image)
                <img src="{{ $image }}" alt="" class="h-full w-full object-cover transition group-hover:scale-[1.02]">
            @else
                <div class="h-full w-full flex items-center justify-center text-sand-400">Illustration</div>
            @endif
        </div>

        <div class="p-4">
            <div class="flex items-start justify-between gap-3">
                <h3 class="font-semibold text-sand-900">{{ $title }}</h3>

                <span
                    class="shrink-0 inline-flex items-center rounded-full border border-gold-500/60 bg-gold-500/10 px-2 py-0.5 text-xs font-semibold text-gold-700"
                    x-show="{{ $model ? $model : 'null' }} == {{ json_encode((string)$value) }}"
                    x-cloak
                >
                    Choisi
                </span>
            </div>

            <div class="mt-3 flex items-center justify-between">
                <div class="text-xs text-sand-700">Cliquer pour choisir</div>
                <div>
                    {{ $slot }}
                </div>
            </div>

            @if($requirements)
                <div
                    class="mt-3 flex items-center justify-between text-xs"
                    :class="{{ $disabled }} ? 'text-red-900' : 'text-sand-700'"
                >
                    {{ $requirements }}
                </div>
            @endif
        </div>
    </div>
</label>
