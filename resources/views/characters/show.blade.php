<x-app-layout size="4xl">
    <div class="space-y-6">
        @php
            $isOwner = auth()->id() === $character->user_id;
        @endphp

        {{-- En-tête --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-bronze-900">
                    {{ $character->name }}
                </h1>
                <p class="text-sm text-sand-700">
                    Personnage de <span class="font-medium text-bronze-700">{{ $character->user->name }}</span>
                </p>
            </div>

            <div class="flex gap-2">
                <x-button-link size="sm" href="{{ route('characters.edit', $character) }}" disabled>
                    Modifier
                </x-button-link>

                <x-button-link variant="secondary" size="sm" href="{{ route('characters.index') }}">
                    ← Retour
                </x-button-link>
            </div>
        </div>

        <x-info-panel :message="session('success')" />

        @if (session('error'))
            <div class="rounded-lg border border-b-red-800 bg-sand-200 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- Encart : prochain événement non confirmé --}}
        @if($isOwner && !empty($nextPendingEvent))
            <div class="rounded-xl border border-gold-200 bg-gold-50 p-5 shadow-sm">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-bronze-900">
                            Prochain événement à confirmer
                        </p>
                        <p class="mt-1 text-sand-800">
                            <span class="font-semibold text-bronze-900">{{ $nextPendingEvent->title }}</span>
                            <span class="text-sand-600">
                                — {{ $nextPendingEvent->starts_at?->format('d/m/Y') }}
                            </span>
                        </p>
                        <p class="mt-1 text-sm text-sand-700">
                            Tu n’as pas encore confirmé ta participation. Tu peux utiliser ce personnage pour t’enregistrer.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <x-button-link
                            size="sm"
                            variant="secondary"
                            href="{{ route('events.show', $nextPendingEvent) }}"
                        >
                            Voir l’événement
                        </x-button-link>

                        <form method="POST" action="{{ route('events.registrations.confirm', $nextPendingEvent) }}">
                            @csrf
                            <input type="hidden" name="character_id" value="{{ $character->id }}">
                            <x-button type="submit" size="sm" variant="primary">
                                M’enregistrer avec ce personnage
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <x-panel-character-team :character="$character" :canEdit="$isOwner" />

        {{-- Panel unique : identité + race + classes --}}
        <x-panel main>
            <div class="flex flex-col md:flex-row gap-x-5 gap-y-2">
                {{-- Race visuelle --}}
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-6 py-4">
                    <div class="flex h-full items-center gap-4">
                        <div class="shrink-0 h-20 aspect-square overflow-hidden rounded-lg border border-sand-200 bg-white">
                            @if(!empty($character->race->image_path))
                                <img
                                    src="{{ asset($character->race->image_path) }}"
                                    alt="Illustration {{ $character->race->title }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                />
                            @else
                                <div class="flex h-full w-full items-center justify-center text-xs text-sand-500">
                                    (image)
                                </div>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-sand-600">Race</p>
                            <p class="text-lg font-semibold text-bronze-900">
                                {{ $character->race->title }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full space-y-2">
                    {{-- Classes visuelles --}}
                    <ul class="flex gap-3">
                        @foreach ($character->classes as $class)
                            <li class="rounded-xl border border-sand-200 bg-white px-4 py-2">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 overflow-hidden rounded-lg border border-sand-200 bg-sand-50">
                                        @if(!empty($class->image_path))
                                            <img
                                                src="{{ asset($class->image_path) }}"
                                                alt="Illustration {{ $class->title }}"
                                                class="h-full w-full object-cover"
                                                loading="lazy"
                                            />
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-[10px] text-sand-500">
                                                (image)
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate font-semibold text-bronze-900">
                                            {{ $class->title }}
                                        </p>
                                        <p class="text-sm text-bronze-600">
                                            Niveau {{ $class->pivot->level }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <dl class="flex gap-3 text-sm">
                        <div class="flex gap-2.5 rounded-lg border border-sand-200 bg-white px-3 py-1">
                            <img src="{{$character->god ? asset($character->god->icon_path) : ''}}"
                                 class="h-9 w-9 rounded-lg object-cover border border-sand-200" alt="">
                            <div class="flex gap-0.5 flex-col">
                                <dt class="text-xs text-sand-700">Dieu</dt>
                                <dd class="font-semibold text-bronze-900">
                                    {{ $character->god ? $character->god->name : '—' }}
                                </dd>
                            </div>
                        </div>

                        <div class="flex gap-0.5 flex-col rounded-lg border border-sand-200 bg-white px-3 py-1">
                            <dt class="text-xs text-sand-700">Genre</dt>
                            <dd class="font-semibold text-bronze-900">
                                {{ $character->gender === 'H' ? 'Homme' : 'Femme' }}
                            </dd>
                        </div>

                        <div class="flex gap-0.5 flex-col rounded-lg border border-sand-200 bg-white px-3 py-1">
                            <dt class="text-xs text-sand-700">Alignement</dt>
                            <dd class="font-semibold text-bronze-900">
                                {{ $character->alignment_label }}
                            </dd>
                        </div>

                        <div class="flex gap-0.5 flex-col rounded-lg border border-sand-200 bg-white px-3 py-1">
                            <dt class="text-xs text-sand-700">PV</dt>
                            <dd class="font-semibold text-bronze-900">
                                À venir
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- BG / Intentions de jeu --}}
            @php
                $canEditNotes = auth()->id() === $character->user_id;
            @endphp

            <div class="mt-6 rounded-xl border border-sand-200 bg-white p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-bronze-900">
                            BG / Intentions de jeu
                        </p>
                        @if($canEditNotes)
                            <p class="mt-1 text-sm text-sand-700">
                                500 caractères max. Les orgas écriront un BG plus complet pour l’histoire.
                            </p>
                        @endif
                    </div>

                    @if($canEditNotes)
                        <span class="shrink-0 rounded-full border border-sand-200 bg-sand-50 px-3 py-1 text-xs text-sand-700">
                            <span x-data="{ len: {{ strlen(old('player_notes', $character->player_notes ?? '')) }} }">
                                <span x-text="len"></span>/500
                            </span>
                        </span>
                    @endif
                </div>

                <form method="POST" action="{{ route('characters.update', $character) }}" class="mt-4 space-y-3">
                    @csrf
                    @method('PUT')

                    <div
                        x-data="{ len: {{ strlen(old('player_notes', $character->player_notes ?? '')) }} }"
                    >
                        @if($canEditNotes)
                            <textarea
                                name="player_notes"
                                rows="5"
                                maxlength="500"
                                @input="len = $event.target.value.length"
                                class="w-full rounded-xl border border-sand-200 bg-sand-50 px-4 py-3 text-sm text-sand-900 placeholder:text-sand-600 focus:border-bronze-400 focus:ring-2 focus:ring-bronze-200 disabled:opacity-60"
                                placeholder="Ex : des détails sur ton passé, un objectif, un conflit, une relation importante…"
                            >{{ old('player_notes', $character->player_notes) }}</textarea>

                            @error('player_notes')
                            <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs text-sand-600">
                                <span x-text="len"></span>/500 caractères
                            </p>
                        @elseif($character->player_notes)
                            <p class="text-sm text-sand-900">{{$character->player_notes}}</p>
                        @else
                            <p class="mt-2 text-sm text-sand-700 italic">
                                Aucun background renseigné.
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-2">
                        @if($canEditNotes)
                            <x-button type="submit" size="sm" variant="primary">
                                Enregistrer
                            </x-button>
                        @else
                            <p class="text-xs text-sand-600">
                                Seul le joueur peut modifier ce champ.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Placeholder progression --}}
            <div class="mt-6 rounded-lg border border-dashed border-bronze-400 bg-sand-50 p-5 text-sm text-bronze-400">
                <p>
                    Compétences, dons et calculs avancés (PV, progression, multiclasse)
                    seront affichés ici ultérieurement.
                </p>
            </div>
        </x-panel>
    </div>
</x-app-layout>
