@props([
  'character',
])

<a href="{{ route('characters.show', $character) }}"
   class="block mt-4 rounded-xl border border-bronze-200 bg-sand-50 p-4">
    <div class="flex items-start justify-between gap-4">
        <h3 class="text-base font-semibold text-sand-900 truncate">
            {{ $character->name }}
        </h3>
        <div class="shrink-0">
            <x-button size="sm" href="{{ route('characters.show', $character) }}">
                Voir la fiche
            </x-button>
        </div>
    </div>

    <div class="mt-2 text-sm text-bronze-500 space-y-0.5">
        <div>
            <span class="text-sand-700">Race :</span>
            {{ $character->race->title }}
        </div>

        <div>
            <span class="text-sand-700">Alignement :</span>
            {{ $character->alignment_label ?? $character->alignment }}
        </div>

        <div>
            <span class="text-sand-700">Classe(s) :</span>
            {{ $character->classes
                ->map(fn ($c) => $c->title . ' niv. ' . $c->pivot->level)
                ->join(', ') }}
        </div>
    </div>
</a>
