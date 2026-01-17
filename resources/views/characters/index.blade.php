<x-app-layout>
    {{-- En-tête --}}
    <div class="flex items-start justify-between gap-4 mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-bronze-800">Personnages</h1>
            <p class="text-sm text-sand-600">
                Gérez vos personnages. Le dernier créé est considéré comme votre personnage principal.
            </p>
        </div>

        <x-button-link variant="primary" size="sm" href="{{ route('characters.create') }}">
            Nouveau personnage
        </x-button-link>
    </div>

    {{-- Liste --}}
    @if ($characters->isEmpty())
        <div class="bg-sand-50 border border-bronze-200 rounded-lg p-8 text-center">
            <p class="text-sand-700">Aucun personnage pour le moment.</p>
            <div class="mt-4">
                <x-button-link variant="primary" href="{{ route('characters.create') }}">
                    Créer mon premier personnage
                </x-button-link>
            </div>
        </div>
    @else
        <ul class="space-y-4">
            @foreach ($characters as $character)
                @php
                    $isMain = $loop->first; // car trié latest()
                    $classesLabel = $character->classes
                        ->map(fn ($c) => $c->title . ' niv. ' . $c->pivot->level)
                        ->join(', ');
                @endphp

                <li class="bg-bronze-50 shadow-sm rounded-lg border border-sand-200 hover:border-bronze-300 transition">
                    <a href="{{ route('characters.show', $character) }}" class="block p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <h2 class="text-base font-medium text-sand-900 truncate">
                                        {{ $character->name }}
                                    </h2>

                                    @if ($isMain)
                                        <span class="inline-flex items-center rounded-full border border-bronze-200 bg-sand-50 px-2 py-0.5 text-xs text-bronze-700">
                                            Principal
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-1 text-sm text-bronze-500 flex flex-wrap gap-x-4 gap-y-1">
                                    <span>
                                        <span class="text-sand-700">Race :</span>
                                        {{ $character->race?->title ?? '—' }}
                                    </span>

                                    <span>
                                        <span class="text-sand-700">Alignement :</span>
                                        {{ $character->alignment_label ?? $character->alignment ?? '—' }}
                                    </span>

                                    <span>
                                        <span class="text-sand-700">Genre :</span>
                                        @if ($character->gender === 'H')
                                            Homme
                                        @elseif ($character->gender === 'F')
                                            Femme
                                        @else
                                            —
                                        @endif
                                    </span>
                                </div>

                                <div class="mt-2 text-sm text-bronze-500">
                                    <span class="text-sand-700">Classe(s) :</span>
                                    {{ $classesLabel !== '' ? $classesLabel : '—' }}
                                </div>
                            </div>

                            <div class="shrink-0 text-right">
                                <div class="text-xs text-sand-700">
                                    Créé le {{ $character->created_at->format('d/m/Y') }}
                                </div>
                                <div class="mt-2">
                                    <x-button variant="ghost" size="sm">
                                        Voir
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
