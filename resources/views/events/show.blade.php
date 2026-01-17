<x-app-layout>
    @php
        $starts = $event->starts_at?->format('d/m/Y H:i');
        $ends = $event->ends_at?->format('d/m/Y H:i');

        $invite = $registration?->invite_status;
        $payment = $registration?->payment_status;

        // Helpers d'affichage (compat enum ou string)
        $inviteValue = is_object($invite) && property_exists($invite, 'value') ? $invite->value : (string) $invite;
        $paymentValue = is_object($payment) && property_exists($payment, 'value') ? $payment->value : (string) $payment;

        $inviteLabel = match ($inviteValue) {
            'invited' => 'Invité',
            'linked' => 'Compte créé',
            'confirmed' => 'Participation confirmée',
            'cancelled' => 'Annulé',
            default => $inviteValue ?: '—',
        };

        $paymentLabel = match ($paymentValue) {
            'unknown' => 'Inconnu',
            'unpaid' => 'Non payé',
            'paid' => 'Payé',
            'refunded' => 'Remboursé',
            default => $paymentValue ?: '—',
        };

        $inviteBadgeClasses = match ($inviteValue) {
            'confirmed' => 'border-teal-200 bg-teal-50 text-teal-800',
            'linked' => 'border-gold-200 bg-gold-50 text-sand-900',
            'invited' => 'border-sand-200 bg-sand-50 text-sand-700',
            'cancelled' => 'border-sand-200 bg-sand-50 text-sand-500',
            default => 'border-sand-200 bg-sand-50 text-sand-700',
        };

        $paymentBadgeClasses = match ($paymentValue) {
            'paid' => 'border-teal-200 bg-teal-50 text-teal-800',
            'unpaid' => 'border-bronze-200 bg-bronze-50 text-bronze-900',
            'unknown' => 'border-sand-200 bg-sand-50 text-sand-700',
            'refunded' => 'border-sand-200 bg-sand-50 text-sand-500',
            default => 'border-sand-200 bg-sand-50 text-sand-700',
        };
    @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="truncate text-2xl font-semibold text-sand-950">{{ $event->title }}</h1>

                    {{-- Type --}}
                    <span class="inline-flex items-center rounded-full border border-sand-200 bg-sand-50 px-2 py-0.5 text-xs font-medium text-sand-700">
                        {{ method_exists($event->type, 'label') ? $event->type->label() : strtoupper((string) $event->type) }}
                    </span>
                </div>

                <p class="mt-2 text-sm text-sand-700">
                    <span class="font-medium text-sand-800">Début :</span> {{ $starts ?? '—' }}
                    @if($ends)
                        <span class="mx-2 text-sand-400">•</span>
                        <span class="font-medium text-sand-800">Fin :</span> {{ $ends }}
                    @endif
                </p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $inviteBadgeClasses }}">
                        Statut : {{ $inviteLabel }}
                    </span>

                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $paymentBadgeClasses }}">
                        Paiement : {{ $paymentLabel }}
                    </span>
                </div>
            </div>

            <div class="flex shrink-0 gap-2">
                <x-button-link href="{{ route('events.index') }}" variant="secondary" size="sm">
                    ← Retour
                </x-button-link>
            </div>
        </div>

        {{-- Bloc "Mon personnage" : visible seulement si participation confirmée --}}
        @if($inviteValue === 'confirmed' && $registration?->character)
            <div class="rounded-xl border border-sand-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-sand-950">Mon personnage</h2>
                        <p class="mt-1 text-sm text-sand-700">
                            Personnage rattaché à cet événement.
                        </p>
                    </div>

                    <x-button-link href="{{ route('characters.index') }}" variant="secondary" size="sm">
                        Voir mes personnages
                    </x-button-link>
                </div>

                <div class="mt-4 rounded-lg border border-sand-200 bg-sand-50 p-4">
                    <p class="text-base font-semibold text-sand-950">
                        {{ $registration->character->name ?? 'Personnage' }}
                    </p>

                    <p class="mt-1 text-sm text-sand-700">
                        {{ $registration->character->race?->name ?? 'Race ?' }}
                        · {{ $registration->character->class?->name ?? 'Classe ?' }}
                        · Niveau {{ $registration->character->level ?? '?' }}
                    </p>
                </div>
            </div>
        @endif

        {{-- Bloc "Participation" : masqué une fois confirmé --}}
        @if(!is_null($registration) && $inviteValue !== 'confirmed')
            <x-panel>
                <h2 class="text-lg font-semibold text-sand-950">Participation</h2>
                <p class="mt-1 text-sm text-sand-700">
                    Pour confirmer votre présence, choisissez le personnage qui participera (paiement géré à part).
                </p>

                <?php
                    $characters = auth()->user()->characters->sortByDesc('created_at')
                ?>

                <div class="mt-4">
                    @if(($characters?->count() ?? 0) === 0)
                        <div class="rounded-lg border border-sand-200 bg-sand-50 p-4">
                            <p class="text-sand-800">
                                Vous devez créer un personnage pour confirmer votre participation.
                            </p>
                            <p class="mt-1 text-sm text-sand-700">
                                Une fois créé, revenez ici pour le sélectionner.
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <x-button-link href="{{ route('characters.create') }}" variant="primary" size="sm">
                                    Créer mon personnage
                                </x-button-link>

                                <x-button-link href="{{ route('characters.index') }}" variant="secondary" size="sm">
                                    Voir mes personnages
                                </x-button-link>
                            </div>
                        </div>
                    @else
                        {{-- Dropdown + validation --}}
                        <form
                            method="POST"
                            {{-- action="{{ route('events.registrations.confirm', $event) }}" --}}
                            class="rounded-lg border border-sand-200 bg-sand-50 p-4"
                            x-data="{
                        open: false,
                        selectedId: {{ (int) ($registration?->character_id ?? ($characters->first()->id ?? 0)) }},
                        options: [
                            @foreach($characters as $c)
                                {
                                    id: {{ (int) $c->id }},
                                    label: @js(($c->name)
                                        .' — '.($c->race?->title)
                                        .' / '.($c->classes
                                                    ->map(fn ($c) => $c->title . ' niv. ' . $c->pivot->level)
                                                    ->join(', '))
                                    ),
                                },
                            @endforeach
                        ],
                        get selectedLabel() {
                            const found = this.options.find(o => o.id === this.selectedId);
                            return found ? found.label : 'Choisir un personnage…';
                        }
                    }"
                        >
                            @csrf

                            <input type="hidden" name="character_id" :value="selectedId">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                <div class="w-full sm:max-w-xl">
                                    <label class="block text-sm font-medium text-sand-900">
                                        Personnage participant
                                    </label>

                                    <div class="relative mt-2">
                                        <button
                                            type="button"
                                            class="flex w-full items-center justify-between gap-3 rounded-lg border border-sand-200 bg-white px-3 py-2 text-left text-sm text-sand-900 shadow-sm"
                                            @click="open = !open"
                                            @keydown.escape.window="open = false"
                                        >
                                            <span class="truncate" x-text="selectedLabel"></span>
                                            <svg class="h-4 w-4 text-sand-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>

                                        <div
                                            x-show="open"
                                            x-transition
                                            @click.outside="open = false"
                                            class="absolute z-20 mt-2 max-h-64 w-full overflow-auto rounded-lg border border-sand-200 bg-white shadow-lg"
                                        >
                                            <template x-for="opt in options" :key="opt.id">
                                                <button
                                                    type="button"
                                                    class="flex w-full px-3 py-2 text-left text-sm hover:bg-sand-50"
                                                    :class="opt.id === selectedId ? 'bg-sand-50 text-sand-950' : 'text-sand-900'"
                                                    @click="selectedId = opt.id; open = false"
                                                >
                                                    <span class="truncate" x-text="opt.label"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>

                                    @error('character_id')
                                    <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex shrink-0 gap-2">
                                    <x-button type="submit" variant="primary">
                                        Valider ma participation
                                    </x-button>

                                    @if($inviteValue === 'cancelled')
                                        <span class="self-center text-sm text-sand-600">
                                    Participation actuellement annulée
                                </span>
                                    @endif
                                </div>
                            </div>

                            <p class="mt-3 text-xs text-sand-600">
                                La validation associe le personnage sélectionné à l’événement et confirme votre participation.
                            </p>
                        </form>
                    @endif
                </div>
            </x-panel>
        @endif

    @can('invite', $event)
        {{-- Admin / Orga : inviter des emails --}}
        <x-panel>
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-sand-950">Inviter des participants</h2>
                    <p class="mt-1 text-sm text-sand-700">
                        Ajoutez une liste d’emails. S’il existe déjà un compte, il sera rattaché immédiatement.
                    </p>
                </div>
            </div>

            {{-- À restreindre plus tard via @can('manage', $event) --}}
            <form method="POST" action="{{ route('events.invite', $event) }}" class="mt-4 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-sand-900" for="emails">Emails</label>
                    <p class="mt-1 text-xs text-sand-600">
                        Un par ligne, ou séparés par virgule/point-virgule/espace.
                    </p>
                    <textarea
                        id="emails"
                        name="emails"
                        rows="6"
                        class="mt-2 w-full rounded-lg border border-sand-200 bg-white px-3 py-2 text-sm text-sand-900 shadow-sm focus:border-bronze-400 focus:outline-none focus:ring-2 focus:ring-bronze-200"
                        placeholder="ex: arthur@exemple.com&#10;merlin@exemple.com"
                        required
                    >{{ old('emails') }}</textarea>
                    @error('emails')
                    <p class="mt-2 text-sm text-bronze-800">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-sand-900" for="payment_status">Statut de paiement</label>
                        <select
                            id="payment_status"
                            name="payment_status"
                            class="mt-2 w-full rounded-lg border border-sand-200 bg-white px-3 py-2 text-sm text-sand-900 shadow-sm focus:border-bronze-400 focus:outline-none focus:ring-2 focus:ring-bronze-200"
                        >
                            <option value="">— Ne pas modifier —</option>
                            <option value="unknown" @selected(old('payment_status') === 'unknown')>Inconnu</option>
                            <option value="unpaid" @selected(old('payment_status') === 'unpaid')>Non payé</option>
                            <option value="paid" @selected(old('payment_status') === 'paid')>Payé</option>
                            <option value="refunded" @selected(old('payment_status') === 'refunded')>Remboursé</option>
                        </select>
                        @error('payment_status')
                        <p class="mt-2 text-sm text-bronze-800">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-end">
                        <x-button type="submit" variant="panel">
                            Traiter les invitations
                        </x-button>
                    </div>
                </div>

                @if (session('success'))
                    <div class="rounded-lg border border-teal-200 bg-teal-50 px-4 py-3 text-sm text-teal-900">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </x-panel>
        @endcan
    </div>
</x-app-layout>
