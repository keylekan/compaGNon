@props([
    'character',
    'canEdit' => false,
])

<div class="rounded-2xl border bg-white border-sand-300 px-6 py-3">
    <div
        x-data="{
            openTeamShow: false,
            openTeamCreate: {{ $errors->has('name') ? 'true' : 'false' }},
            openTeamJoin: {{ $errors->has('slug') ? 'true' : 'false' }},
            copied: false,
            async copy(text) {
                try {
                    await navigator.clipboard.writeText(text);
                    this.copied = true;
                    setTimeout(() => this.copied = false, 1200);
                } catch (e) {}
            }
        }"
    >
        @if($character->team)
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <span class="text-xs uppercase tracking-wide text-sand-700 mr-1">Équipe</span>
                        <button
                            type="button"
                            class="text-bronze-700 hover:underline font-medium cursor-pointer"
                            @click="openTeamShow = true"
                        >
                            {{ $character->team->name }}
                        </button>
                    </div>

                    @if($canEdit)
                        <form method="POST" action="{{ route('characters.team.leave', $character) }}">
                            @csrf
                            @method('DELETE')
                            <x-button variant="panel" size="sm" type="submit">
                                Quitter
                            </x-button>
                        </form>
                    @endif
                </div>

                <div class="text-sm text-sand-700 font-medium">
                    <button
                        type="button"
                        class="hover:underline cursor-pointer font-mono"
                        @click="copy('{{ $character->team->slug }}')"
                    >
                        {{ '@' . $character->team->slug }}
                    </button>

                    <span x-show="!copied" class="ml-1 text-xs">
                        @if($canEdit)
                            Ceci est votre tag d'équipe. Cliquez dessus pour le copier et partagez-le aux personnes qui doivent rejoindre l'équipe.
                        @else
                            Ceci est le tag d'équipe. Cliquez dessus pour le copier.
                        @endif
                    </span>

                    <span x-show="copied" x-cloak class="ml-1 text-xs font-medium">
                        Copié ✓
                    </span>
                </div>
            </div>

            {{-- Modale : affichage équipe --}}
            <x-modal show="openTeamShow" title="Équipe" :canClose="true">
                <div class="space-y-4">
                    <div>
                        <div class="text-lg font-semibold text-sand-900">
                            {{ $character->team->name }}
                        </div>

                        @if($character->team->bg)
                            <p class="mt-2 text-sm text-sand-900 whitespace-pre-line">
                                {{ $character->team->bg }}
                            </p>
                        @else
                            <p class="mt-2 text-sm text-sand-700 italic">
                                Aucun background renseigné.
                            </p>
                        @endif
                    </div>

                    <div class="rounded-md border border-sand-200 bg-sand-50 p-3">
                        <div class="text-sm font-medium text-sand-800 mb-2">Membres</div>
                        <ul class="space-y-1 text-sm text-sand-800">
                            @foreach($character->team->characters as $member)
                                <li class="flex items-center gap-2">
                                    <span>{{ $member->name }}</span>
                                    @if($member->id === $character->id)
                                        <span class="text-xs text-bronze-500 font-medium">Vous</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex items-center justify-end gap-2">
                        <x-button variant="secondary" type="button" @click="openTeamShow = false">
                            Fermer
                        </x-button>
                    </div>
                </div>
            </x-modal>
        @elseif($canEdit)
            <div class="flex flex-wrap items-center gap-2">
                <div class="text-sm text-bronze-800 font-medium">
                    Si vous faites partie d'un groupe de joueurs, rejoignez-le en demandant son
                    <x-tooltip text="Le tag est un identifiant unique de la forme 'les-petits-pedestres-xy1z2'"><strong>tag</strong></x-tooltip>
                    à votre responsable de groupe ou créez-le si vous êtes le responsable
                </div>

                <x-button type="button" variant="primary" size="sm" @click="openTeamCreate = true">
                    Créer une équipe
                </x-button>

                <x-button type="button" variant="panel" size="sm" @click="openTeamJoin = true">
                    Rejoindre une équipe
                </x-button>
            </div>

            {{-- Modale : création équipe --}}
            <x-modal show="openTeamCreate" title="Créer une équipe" :canClose="true">
                <form method="POST" action="{{ route('characters.team.store', $character) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-sand-800 mb-1">Nom</label>
                        <x-input name="name" value="{{ old('name') }}" full />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-sand-800 mb-1">Background (max 500)</label>
                        <textarea
                            name="bg"
                            maxlength="500"
                            class="w-full rounded-md border border-sand-200 bg-sand-50 p-2 text-sand-900"
                            rows="5"
                        >{{ old('bg') }}</textarea>
                        @error('bg')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-2">
                        <x-button type="button" variant="ghost" @click="openTeamCreate = false">
                            Annuler
                        </x-button>
                        <x-button type="submit" variant="primary">
                            Créer
                        </x-button>
                    </div>
                </form>
            </x-modal>

            {{-- Modale : rejoindre équipe --}}
            <x-modal show="openTeamJoin" title="Rejoindre une équipe" :canClose="true">
                <form method="POST" action="{{ route('characters.team.join', $character) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-sand-800 mb-1">
                            <x-tooltip text="Le tag est un identifiant unique de la forme 'les-petits-pedestres-xy1z2'">Tag d’équipe</x-tooltip>
                            <span class="ml-1 text-xs text-sand-700">
                                Demandez-le à votre responsable d'équipe. Pour lui, il apparaît sous le nom de l'équipe.
                            </span>
                        </label>
                        <x-input name="slug" value="{{ old('slug') }}" full />
                    </div>

                    <div class="flex items-center justify-end gap-2">
                        <x-button type="button" variant="ghost" @click="openTeamJoin = false">
                            Annuler
                        </x-button>
                        <x-button type="submit" variant="secondary">
                            Rejoindre
                        </x-button>
                    </div>
                </form>
            </x-modal>
        @else
            <p class="text-sm text-sand-800 italic">
                Aucune équipe rejointe.
            </p>
        @endif
    </div>
</div>
