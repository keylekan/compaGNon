@php use App\Enums\InviteStatus;use App\Enums\PaymentStatus; @endphp
@props([
    'registrations', // LengthAwarePaginator<EventRegistration>
    'filters' => ['q' => '', 'invite_status' => '', 'payment_status' => ''],
])

@php
    $genderLabel = function (?string $gender) {
        return match ($gender) {
            'H' => 'Homme',
            'F' => 'Femme',
            default => $gender ? ucfirst($gender) : '—',
        };
    };

    $inviteOptions = [
        InviteStatus::INVITED->value => InviteStatus::INVITED->label(),
        InviteStatus::CONFIRMED->value => InviteStatus::CONFIRMED->label(),
        InviteStatus::CANCELLED->value => InviteStatus::CANCELLED->label(),
    ];

    $paymentOptions = [
        PaymentStatus::UNKNOWN->value => PaymentStatus::UNKNOWN->label(),
        PaymentStatus::UNPAID->value => PaymentStatus::UNPAID->label(),
        PaymentStatus::PAID->value => PaymentStatus::PAID->label(),
        PaymentStatus::REFUNDED->value => PaymentStatus::REFUNDED->label(),
    ];
@endphp

<x-panel class="space-y-4" :main="false">
    {{-- Barre de filtres --}}
    <form method="GET" class="grid gap-3 md:grid-cols-12">
        <div class="md:col-span-6">
            <label class="block text-xs font-medium opacity-80 mb-1">Recherche</label>
            <x-input
                class="w-full"
                name="q"
                :value="$filters['q'] ?? ''"
                placeholder="Nom du joueur, du perso, de l'équipe…"
            />
        </div>

        <div class="md:col-span-3">
            <label class="block text-xs font-medium opacity-80 mb-1">Statut invitation</label>
            <x-select name="invite_status">
                <option value="">Tous</option>
                @foreach ($inviteOptions as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['invite_status'] ?? '') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="md:col-span-3">
            <label class="block text-xs font-medium opacity-80 mb-1">Statut paiement</label>
            <x-select name="payment_status">
                <option value="">Tous</option>
                @foreach ($paymentOptions as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['payment_status'] ?? '') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="md:col-span-12 flex items-center gap-2">
            <x-button type="submit" variant="primary" size="sm">Filtrer</x-button>

            <x-button-link
                :href="url()->current()"
                variant="ghost"
                size="sm"
                :disabled="(($filters['q'] ?? '')==='' && ($filters['invite_status'] ?? '')==='' && ($filters['payment_status'] ?? '')==='')"
            >
                Réinitialiser
            </x-button-link>

            <div class="ml-auto text-xs opacity-70">
                {{ $registrations->total() }} inscrit(s)
            </div>
        </div>
    </form>

    {{-- Liste --}}
    <div class="divide-y divide-sand-400 rounded-lg border border-sand-400">
        @forelse ($registrations as $reg)
            @php
                $userName = empty($reg->user?->name) ? 'Invité' : $reg->user?->name;
                $userAge = $reg->user?->age;
                $email = $reg->email;

                $char = $reg->character;
                $charName = $char?->name ?? '—';
                $charGender = $char ? $genderLabel($char->gender) : '—';
                $charGod = $char?->god ? $char->god->name : '—';
                $alignCode = $char?->alignment ?? '—';

                $race = $char?->race?->title;
                $classes = $char?->classes
                        ->map(fn ($c) => $c->title . ' niv. ' . $c->pivot->level)
                        ->join(', ');
            @endphp

            <div class="grid px-2 py-1 gap-2 sm:grid-cols-7 md:grid-cols-42 md:items-center">
                {{-- Joueur --}}
                <div class="sm:col-span-3 md:col-span-10">
                    <div class="text-sm font-semibold {{empty($reg->user?->name) ? 'opacity-70' : ''}}">
                        {{ $userName }}
                        @if($userAge) <span class="text-xs font-medium text-sand-800">{{$userAge}} ans</span> @endif
                    </div>
                    <div class="text-xs opacity-70">
                        {{ $email }}
                    </div>
                </div>

                {{-- Perso --}}
                <div class="sm:col-span-4 md:col-span-20">
                    @if($char)
                        <a
                            href="{{ route('characters.show', $char) }}"
                            target="_blank"
                            class="cursor-pointer block px-2 py-1 hover:bg-sand-200 transition rounded-md"
                        >
                            <div class="text-sm">
                                <span class="font-semibold">{{ $charName }}</span><!--
                             -->@if($char->team)<!--
                                 --><span class="text-xs font-medium text-sand-800"> ({{ $char->team->name }})</span><!--
                             -->@endif<!--
                             --><span class="text-xs font-medium text-sand-800">, {{ $charGod }}, {{ $charGender }}, {{ $alignCode }}</span>
                            </div>
                            <div class="text-sm text-bronze-500">
                                {{ $race }}, {{ $classes }}
                            </div>
                        </a>
                    @else
                        <span class="px-2 py-1 text-xs text-sand-800">
                            En attente du personnage
                        </span>
                    @endif
                </div>

                {{-- Statut invitation --}}
                <div class="sm:col-span-3 md:col-span-7">
                    <div class="text-xs opacity-70 mb-1">Invitation</div>
                    <div class="flex items-center gap-1">
                        <x-badge-invite :status="$reg->invite_status" />
                        @if($char)
                        <div
                            x-data="{ open: false }"
                            @keydown.escape.window="open = false"
                            class="relative inline-flex"
                        >
                            <button
                                class="p-0.5 rounded-2xl cursor-pointer border border-sand-300 bg-sand-100 hover:bg-sand-50"
                                @click="open = !open"
                            >
                                <svg class="h-4 w-4 text-sand-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- Dropdown -->
                            <div
                                x-show="open"
                                x-transition.origin.top.right
                                @click.outside="open = false"
                                x-cloak
                                class="absolute right-0 top-full z-10 mt-1 bg-white border border-sand-300 rounded shadow-lg"
                            >
                                @if($reg->invite_status !== InviteStatus::ACCEPTED)
                                    <form method="POST" action="{{route('events.registrations.accept', $reg)}}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="block w-full px-4 py-2 hover:bg-sand-100"
                                        >
                                            Accepter
                                        </button>
                                    </form>
                                @endif
                                @if($reg->invite_status !== InviteStatus::REFUSED)
                                    <form method="POST" action="{{route('events.registrations.refuse', $reg)}}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="block w-full px-4 py-2 hover:bg-sand-100"
                                        >
                                            Refuser
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Statut paiement --}}
                <div class="sm:col-span-3 md:col-span-5">
                    <div class="text-xs opacity-70 mb-1">Paiement</div>
                    <x-badge-payment :status="$reg->payment_status"/>
                </div>
            </div>
        @empty
            <div class="p-6 text-sm opacity-80">
                Aucun invité ne correspond aux filtres.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pt-2">
        {{ $registrations->links() }}
    </div>
</x-panel>
