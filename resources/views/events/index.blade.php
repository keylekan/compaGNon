<x-app-layout size="4xl">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-sand-950">Événements</h1>
                <p class="mt-1 text-sm text-sand-700">
                    Retrouvez vos événements à venir et votre statut.
                </p>
            </div>

            @can('create', \App\Models\Event::class)
                <x-button-link href="{{ route('events.create') }}" variant="primary" size="sm">
                    Créer un événement
                </x-button-link>
            @endcan
        </div>

        @if (session('success'))
            <div class="rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900">
                {{ session('success') }}
            </div>
        @endif

        {{-- Liste --}}
        @if($events->isEmpty())
            <div class="rounded-xl border border-sand-200 bg-sand-50 p-6">
                <p class="text-sand-800">
                    Aucun événement n’est disponible pour le moment.
                </p>
                <p class="mt-2 text-sm text-sand-700">
                    Si vous venez d’être invité, assurez-vous d’avoir créé un compte avec le bon email.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($events as $event)
                    @php
                        // Optionnel : tu peux récupérer la registration via eager loading plus tard.
                        // Ici on se contente d'afficher les infos event.
                        $starts = $event->starts_at?->format('d/m/Y H:i');
                        $ends = $event->ends_at?->format('d/m/Y H:i');
                    @endphp

                    <a href="{{ route('events.show', $event) }}"
                       class="rounded-xl border border-sand-200 bg-white p-5 shadow-sm transition hover:border-bronze-300">
                        <div class="flex items-start justify-between gap-4">
                            @php
                                $eventCharacter = $event->myRegistration?->character;
                            @endphp

                            <div class="min-w-0">
                                <div class="flex items-center gap-3">
                                    <h2 class="truncate text-lg font-semibold text-sand-950 group-hover:text-bronze-700">
                                        {{ $event->title }}
                                    </h2>

                                    {{-- Type --}}
                                    <span class="inline-flex items-center rounded-full border border-sand-200 bg-sand-50 px-2 py-0.5 text-xs font-medium text-sand-700">
                                        {{ method_exists($event->type, 'label') ? $event->type->label() : strtoupper((string) $event->type) }}
                                    </span>

                                    @if($eventCharacter)
                                        <span class="text-xs text-sand-800 font-medium">Enregistré avec {{$eventCharacter->name}}</span>
                                    @elseif($event->myRegistration)
                                        <span class="text-xs text-bronze-500 font-medium">Vous devez encore vous enregistrer</span>
                                    @endif
                                </div>

                                <p class="mt-2 text-sm text-sand-700">
                                    <span class="font-medium text-sand-800">Début :</span> {{ $starts ?? '—' }}
                                    @if($ends)
                                        <span class="mx-2 text-sand-400">•</span>
                                        <span class="font-medium text-sand-800">Fin :</span> {{ $ends }}
                                    @endif
                                </p>

                                <p class="mt-3 text-sm text-sand-700">
                                    Cliquez pour voir les détails
                                    @if(!$eventCharacter)
                                        , confirmer votre participation et rattacher votre personnage.
                                    @endif
                                </p>
                            </div>

                            <div class="shrink-0">
                                <span class="inline-flex items-center rounded-lg border border-sand-200 bg-sand-50 px-3 py-1 text-sm text-sand-800">
                                    Voir
                                    <span class="ml-2 text-sand-600">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
