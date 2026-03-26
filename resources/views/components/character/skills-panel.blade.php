@props([
    'character',
    'availablePoints' => [
        'points_c' => 0,
        'points_l' => 0,
        'points_v' => 0,
        'points_r' => 0,
    ],
    'availableSkills' => collect(),
])

<div
    x-data="{ open: false }"
    class="mt-6 space-y-4"
>
    <div class="rounded-xl border border-sand-200 bg-white p-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h2 class="text-sm font-semibold text-bronze-900">
                    Compétences
                </h2>
                <p class="mt-1 text-sm text-sand-700">
                    Consulte tes points disponibles et achète de nouvelles compétences.
                </p>
            </div>

            <div class="flex gap-2">
                <x-button
                    type="button"
                    size="sm"
                    variant="primary"
                    x-on:click="open = true"
                >
                    Acheter une compétence
                </x-button>
            </div>
        </div>

        {{-- Points disponibles --}}
        <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
            @if($availablePoints['points_c'] !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points C</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $availablePoints['points_c'] ?? 0 }}
                    </p>
                </div>
            @endif

            @if($availablePoints['points_l'] !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points L</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $availablePoints['points_l'] ?? 0 }}
                    </p>
                </div>
            @endif

            @if($availablePoints['points_v'] !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points V</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $availablePoints['points_v'] ?? 0 }}
                    </p>
                </div>
            @endif

            @if($availablePoints['points_r'] !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points V1</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $availablePoints['points_r'] ?? 0 }}
                    </p>
                </div>
            @endif
        </div>

        {{-- Compétences déjà acquises --}}
        <div class="mt-6">
            <div class="flex items-center justify-between gap-3">
                <p class="text-sm font-semibold text-bronze-900">
                    Compétences acquises
                </p>
            </div>

            @if($character->skills->isEmpty())
                <div class="mt-3 rounded-lg border border-dashed border-sand-300 bg-sand-50 px-4 py-4 text-sm text-sand-700">
                    Aucune compétence achetée pour le moment.
                </div>
            @else
                <ul class="mt-3 grid gap-3 md:grid-cols-2">
                    @foreach($character->skills as $skill)
                        <li class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-bronze-900">
                                        {{ $skill->name }}
                                    </p>

                                    @if(!empty($skill->description))
                                        <p class="mt-1 text-sm text-sand-700">
                                            {{ $skill->description }}
                                        </p>
                                    @endif
                                </div>

                                <div class="shrink-0 rounded-full border border-sand-200 bg-white px-2.5 py-1 text-xs text-bronze-700">
                                    {{ strtoupper($skill->type) }}
                                    · {{ $skill->cost }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Modale d'achat --}}
    <x-modal
        show="open"
        canClose="true"
        title="Acheter une compétence"
    >
        <div class="space-y-4">
            <div class="rounded-lg border border-sand-200 bg-sand-50 px-4 py-3 text-sm text-sand-800">
                <p class="font-medium text-bronze-900">Points disponibles</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        C : {{ $availablePoints['points_c'] ?? 0 }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        L : {{ $availablePoints['points_l'] ?? 0 }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        V : {{ $availablePoints['points_v'] ?? 0 }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        V1 : {{ $availablePoints['points_r'] ?? 0 }}
                    </span>
                </div>
            </div>

            @if($availableSkills->isEmpty())
                <div class="rounded-lg border border-dashed border-sand-300 bg-sand-50 px-4 py-4 text-sm text-sand-700">
                    Aucune compétence disponible à l’achat.
                </div>
            @else
                <div class="max-h-[60vh] space-y-3 overflow-y-auto pr-1">
                    @foreach($availableSkills as $skill)
                        @php
                            $pointKey = match ($skill->type) {
                                'c' => 'points_c',
                                'l' => 'points_l',
                                'v' => 'points_v',
                                'r' => 'points_r',
                                default => null,
                            };

                            $available = $pointKey ? ($availablePoints[$pointKey] ?? 0) : 0;
                            $canBuy = $available >= $skill->cost;
                        @endphp

                        <div class="rounded-xl border border-sand-200 bg-white p-4">
                            <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="font-semibold text-bronze-900">
                                            {{ $skill->title }}
                                        </p>
                                        <span class="rounded-full border border-sand-200 bg-sand-50 px-2 py-0.5 text-[11px] text-bronze-700">
                                            Coût : {{ $skill->cost }}
                                        </span>
                                    </div>

                                    @if(!empty($skill->description))
                                        <x-markdown class="mt-2 text-sm" value="{{ Js::from($skill->description) }}" />
                                    @endif
                                </div>

                                <div class="shrink-0">
                                    <form method="POST" action="{{ route('characters.skills.store', $character) }}">
                                        @csrf
                                        <input type="hidden" name="skill_id" value="{{ $skill->id }}">

                                        <x-button
                                            type="submit"
                                            size="sm"
                                            variant="{{ $canBuy ? 'primary' : 'secondary' }}"
                                            :disabled="! $canBuy"
                                        >
                                            {{ $canBuy ? 'Acheter' : 'Points insuffisants' }}
                                        </x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex justify-end">
                <x-button
                    type="button"
                    size="sm"
                    variant="ghost"
                    x-on:click="open = false"
                >
                    Fermer
                </x-button>
            </div>
        </div>
    </x-modal>
</div>
