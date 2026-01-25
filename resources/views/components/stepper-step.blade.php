@props([
    'pos',
    'title',
    'subtitle',
    'disabled' => false,
])

<div x-show="step === {{$pos}}" x-transition>
    <x-panel>
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-sand-900">{{$title}}</h2>
                @if($subtitle)
                <p class="mt-1 text-sm text-sand-600">
                    {{$subtitle}}
                </p>
                @endif
            </div>
            @if($pos > 1)
            <x-button
                variant="secondary"
                @click="go({{$pos - 1}})"
            >
                ← Retour
            </x-button>
            @endif
        </div>

        {{ $slot }}

        <div class="mt-6 flex items-center justify-end gap-3">
            <button type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-bronze-600 px-4 py-2.5 font-semibold text-white
           hover:bg-bronze-700 disabled:opacity-50"
                    :disabled="{{$disabled}}"
                    @click="go({{$pos + 1}})">
                Continuer
            </button>
        </div>
    </x-panel>
</div>
