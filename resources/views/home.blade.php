<x-app-layout>
    <x-slot:header>
        <h1 class="text-2xl font-semibold">Tableau de bord</h1>
        <p class="mt-1 text-sand-700">Votre personnage et vos prochains événements.</p>
    </x-slot:header>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Mon personnage --}}
        @php
            $mainCharacter = auth()->user()->mainCharacter;
        @endphp

        <x-panel class="lg:col-span-1 self-start">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Mon personnage</h2>
                    <p class="mt-1 text-sm text-sand-700">Accès rapide à votre fiche.</p>
                </div>
                <x-button-link href="{{ route('characters.index') }}" variant="panel">
                    Gérer
                </x-button-link>
            </div>

            @if ($mainCharacter)
                {{-- Personnage principal --}}
                <a href="{{ route('characters.show', $mainCharacter) }}"
                   class="block mt-4 rounded-xl border border-bronze-200 bg-sand-50 p-4">
                    <div class="flex items-start justify-between gap-4">
                        <h3 class="text-base font-semibold text-sand-900 truncate">
                            {{ $mainCharacter->name }}
                        </h3>
                        <div class="shrink-0">
                            <x-button size="sm" href="{{ route('characters.show', $mainCharacter) }}">
                                Voir la fiche
                            </x-button>
                        </div>
                    </div>

                    <div class="mt-2 text-sm text-sand-700 space-y-0.5">
                        <div>
                            <span class="text-sand-600">Race :</span>
                            {{ $mainCharacter->race?->title ?? '—' }}
                        </div>

                        <div>
                            <span class="text-sand-600">Alignement :</span>
                            {{ $mainCharacter->alignment_label ?? $mainCharacter->alignment }}
                        </div>

                        <div>
                            <span class="text-sand-600">Classe(s) :</span>
                            {{ $mainCharacter->classes
                                ->map(fn ($c) => $c->title . ' niv. ' . $c->pivot->level)
                                ->join(', ') }}
                        </div>
                    </div>
                </a>
            @else
                {{-- État vide --}}
                <div class="mt-4 rounded-xl bg-sand-50 p-4 text-sm text-sand-800">
                    Vous n’avez pas encore créé de personnage.
                    <div class="mt-3">
                        <a href="{{ route('characters.create') }}"
                           class="inline-flex rounded-lg bg-bronze-500 px-4 py-2 font-semibold text-sand-50 hover:bg-bronze-600">
                            Créer un personnage
                        </a>
                    </div>
                </div>
            @endif
        </x-panel>

        {{-- Événements à venir --}}
        <x-panel class="lg:col-span-2">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Événements à venir</h2>
                    <p class="mt-1 text-sm text-sand-700">
                        Les prochaines dates où vous êtes inscrit.
                    </p>
                </div>

                <x-button-link
                    href="{{ route('events.index') }}"
                    variant="panel"
                >
                    Voir tout
                </x-button-link>
            </div>

            @if($upcomingEvents->isEmpty())
                <div class="mt-6 rounded-lg border border-sand-200 bg-sand-50 p-4">
                    <p class="text-sand-800">
                        Aucun événement à venir pour le moment.
                    </p>
                    <p class="mt-1 text-sm text-sand-700">
                        Consultez la liste complète des événements ou revenez plus tard.
                    </p>

                    <div class="mt-4">
                        <x-button-link
                            href="{{ route('events.index') }}"
                            variant="secondary"
                            size="sm"
                        >
                            Voir les événements
                        </x-button-link>
                    </div>
                </div>
            @else
                <ul class="mt-4 divide-y divide-sand-200">
                    @foreach($upcomingEvents as $event)
                        <li class="flex items-center justify-between gap-4 py-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                            <span class="font-medium text-sand-950 truncate">
                                {{ $event->title }}
                            </span>

                                    <span class="inline-flex items-center rounded-full border border-sand-200 bg-sand-50 px-2 py-0.5 text-xs font-medium text-sand-700">
                                {{ method_exists($event->type, 'label') ? $event->type->label() : strtoupper((string) $event->type) }}
                            </span>
                                </div>

                                <div class="mt-1 text-sm text-sand-700">
                                    @php
                                        $start = $event->starts_at;
                                        $end = $event->ends_at;

                                        $sameDay = $end && $start->toDateString() === $end->toDateString();
                                    @endphp

                                    {{ $start->translatedFormat(!$end || $sameDay ? 'l j F Y · H:i' : ' j F Y · H:i') }}

                                    @if($end)
                                        @if($sameDay)
                                            <span class="text-sand-400">—</span>
                                            {{ $end->translatedFormat('H:i') }}
                                        @else
                                            <span class="text-sand-400">→</span>
                                            {{ $end->translatedFormat('j F Y · H:i') }}
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="shrink-0">
                                <a
                                    href="{{ route('events.show', $event) }}"
                                    class="text-sm font-semibold text-teal-600 hover:text-teal-700 underline underline-offset-4"
                                >
                                    Détails
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-panel>
    </div>
</x-app-layout>
