@props([
    'character',
    'availablePoints' => [
        'c' => 0,
        'l' => 0,
        'v' => 0,
        'r' => 0,
    ],
    'availableSkills' => collect(),
])

@php
    $points_c = $availablePoints['c'] ?? 0;
    $points_l = $availablePoints['l'] ?? 0;
    $points_v = $availablePoints['v'] ?? 0;
    $points_r = $availablePoints['r'] ?? 0;

    $skills = $character->aggregatedSkills()->get();
@endphp

<div
    x-data="{ open: false }"
    class="mt-6 space-y-4"
>
    <div id="skills" class="rounded-xl border border-sand-200 bg-white p-5">
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

        <x-info-panel class="mt-5" :message="session('skill-success')" />

        @if (session('skill-error'))
            <div class="mt-5 rounded-lg border border-b-red-800 bg-sand-200 px-4 py-3 text-sm text-red-800">
                {{ session('skill-error') }}
            </div>
        @endif

        {{-- Points disponibles --}}
        <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
            @if($points_c !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points C</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $points_c }}
                    </p>
                </div>
            @endif

            @if($points_l !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points L</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $points_l }}
                    </p>
                </div>
            @endif

            @if($points_v !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points V</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $points_v }}
                    </p>
                </div>
            @endif

            @if($points_r !== 0)
                <div class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                    <p class="text-xs uppercase tracking-wide text-sand-600">Points V1</p>
                    <p class="mt-1 text-2xl font-semibold text-bronze-900">
                        {{ $points_r }}
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

            @if($skills->isEmpty())
                <div class="mt-3 rounded-lg border border-dashed border-sand-300 bg-sand-50 px-4 py-4 text-sm text-sand-700">
                    Aucune compétence achetée pour le moment.
                </div>
            @else
                <ul class="mt-3 grid gap-3 md:grid-cols-2">
                    @foreach($skills as $skill)
                        <li class="rounded-xl border border-sand-200 bg-sand-50 px-4 py-3">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-semibold text-bronze-900">
                                            {{ $skill->title }}
                                        </h3>

                                        @if($skill->is_feat)
                                            <span class="inline-flex items-center rounded-full border border-bronze-600 bg-bronze-400 px-2 py-0.5 text-xs font-semibold text-white">
                                                Don
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full border border-bronze-400 bg-bronze-100 px-2 py-0.5 text-xs font-semibold text-bronze-800">
                                                x{{ $skill->quantity }}
                                            </span>
                                        @endif

                                        <form
                                            class="ml-auto"
                                            method="POST"
                                            action="{{ route('characters.skills.destroy', [$character, $skill]) }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            @if(! $skill->locked)
                                                <x-button variant="primary" size="sm" type="submit">
                                                    Supprimer
                                                </x-button>
                                            @endif
                                        </form>
                                    </div>

                                    @if(!empty($skill->description))
                                        <p class="mt-1 text-sm text-sand-700">
                                            {{ Str::limit($skill->description, 120) }}
                                        </p>
                                    @endif

                                    <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                        @if(($skill->cost_paid_c ?? 0) > 0)
                                            <span class="rounded-full border border-sand-300 bg-white px-2 py-1 text-sand-800">
                                                {{ $skill->cost_paid_c }}C
                                            </span>
                                        @endif

                                        @if(($skill->cost_paid_l ?? 0) > 0)
                                            <span class="rounded-full border border-sand-300 bg-white px-2 py-1 text-sand-800">
                                                {{ $skill->cost_paid_l }}L
                                            </span>
                                        @endif

                                        @if(($skill->cost_paid_v ?? 0) > 0)
                                            <span class="rounded-full border border-sand-300 bg-white px-2 py-1 text-sand-800">
                                                {{ $skill->cost_paid_v }}V
                                            </span>
                                        @endif

                                        @if(($skill->cost_paid_r ?? 0) > 0)
                                            <span class="rounded-full border border-sand-300 bg-white px-2 py-1 text-sand-800">
                                                {{ $skill->cost_paid_r }}V1
                                            </span>
                                        @endif
                                    </div>
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
                        C : {{ $points_c }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        L : {{ $points_l }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        V : {{ $points_v }}
                    </span>
                    <span class="rounded-full border border-sand-200 bg-white px-3 py-1 text-xs text-bronze-700">
                        V1 : {{ $points_r }}
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
                        $maxCost = max($skill->cost_c, $skill->cost_l, $skill->cost_v, $skill->cost_r);
                        $weight_c = $skill->cost_c > 0 ? $maxCost / $skill->cost_c : 0;
                        $weight_l = $skill->cost_l > 0 ? $maxCost / $skill->cost_l : 0;
                        $weight_v = $skill->cost_v > 0 ? $maxCost / $skill->cost_v : 0;
                        $weight_r = $skill->cost_r > 0 ? $maxCost / $skill->cost_r : 0;
                        @endphp

                        <x-skill-payment
                            :action="route('characters.skills.store', $character)"
                            method="POST"
                            :skill="$skill"
                            :target="$maxCost"
                            :balances="[
                                'C' => $points_c,
                                'L' => $points_l,
                                'V' => $points_v,
                                'V1' => $points_r,
                            ]"
                            :weights="[
                                'C' => $weight_c,
                                'L' => $weight_l,
                                'V' => $weight_v,
                                'V1' => $weight_r,
                            ]"
                        />
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
