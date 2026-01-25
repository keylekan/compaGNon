@props([
    'gods',
    'selectedGodId',
    'isAllowed',
])

<div x-data="{ details: false }" class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($gods as $god)
        @php
            $allowedBelieverAlignments = Js::from($god->allowed_believer_alignments)
        @endphp

        <x-choice-line
            name="god_id"
            :value="$god->id"
            :title="$god->name"
            :description="$god->short_description"
            :image="$god->icon_path ? asset($god->icon_path) : null"
            model="selectedGodId"
            disabled="!{{$isAllowed}}({{ Js::from($god) }})"
        >
            <x-button
                variant="secondary"
                size="sm"
                @click.stop="details = {{ Js::from($god) }}"
            >
                Détails
            </x-button>
        </x-choice-line>
    @endforeach

    {{-- Modal Détails --}}
    <x-modal show="details" :title="'Détails'">
        <div class="space-y-4">
            <template x-if="details">
                <div>
                    <div class="flex items-start gap-3">
                        <img
                            class="h-14 w-14 rounded-md border border-black/10 object-cover"
                            :src="details.icon_path ? '/' + details.icon_path : '{{ asset('images/logo.svg') }}'"
                            :alt="`Insigne de ${details.name}`"
                        >

                        <div class="min-w-0">
                            <div class="text-lg font-semibold" x-text="details.name ?? ''"></div>
                            <p class="mt-1 text-sm opacity-80" x-text="details.short_description ?? ''"></p>
                        </div>
                    </div>

                    <x-markdown class="mt-2 text-sm text-sand-800"  value="details.description || '—'" />

                    <div class="mt-5 flex justify-end gap-3">
                        <button type="button"
                                class="rounded-xl border border-sand-200 bg-white px-4 py-2 font-semibold text-sand-700 hover:bg-sand-50"
                                @click="details = false"
                        >
                            Fermer
                        </button>

                        <button type="button"
                                class="rounded-xl bg-bronze-600 px-4 py-2 font-semibold text-white hover:bg-bronze-700"
                                @click="{{$selectedGodId}} = String(details.id); details = false"
                        >
                            Choisir
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </x-modal>
</div>
