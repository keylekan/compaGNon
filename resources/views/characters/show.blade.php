<x-app-layout>
    <div class="space-y-6">
        {{-- En-tête --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-bronze-800">
                    {{ $character->name }}
                </h1>
                <p class="text-sm text-sand-700">
                    Personnage de {{ $character->user->name }}
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

        {{-- Carte identité --}}
        <x-panel main>
            <h2 class="text-lg font-medium text-bronze-700 mb-4">
                Identité
            </h2>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                <div>
                    <dt class="text-sand-700">Race</dt>
                    <dd class="text-sand-900">{{ $character->race->title }}</dd>
                </div>

                <div>
                    <dt class="text-sand-700">Genre</dt>
                    <dd class="text-sand-900">
                        {{ $character->gender === 'H' ? 'Homme' : 'Femme' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sand-700">Alignement</dt>
                    <dd class="text-sand-900">{{ $character->alignment_label }}</dd>
                </div>

                <div>
                    <dt class="text-sand-700">PV</dt>
                    <dd class="text-sand-900">À venir</dd>
                </div>
            </dl>
        </x-panel>

        {{-- Classes --}}
        <x-panel main>
            <h2 class="text-lg font-medium text-bronze-700 mb-4">
                Classe{{ $character->classes->count() > 1 ? 's' : '' }}
            </h2>

            <ul class="space-y-2">
                @foreach ($character->classes as $class)
                    <li class="flex items-center justify-between rounded-md border border-sand-200 bg-white px-4 py-2">
                        <span class="text-sand-900">
                            {{ $class->title }}
                        </span>
                        <span class="text-sm text-bronze-400">
                            Niveau {{ $class->pivot->level }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </x-panel>

        {{-- Placeholder progression --}}
        <div class="bg-sand-50 border border-dashed border-bronze-400 rounded-lg p-6 text-sm text-bronze-300">
            <p>
                Les compétences, dons et calculs avancés (PV, progression, multiclasse)
                seront affichés ici ultérieurement.
            </p>
        </div>
    </div>
</x-app-layout>
