@props([
    'classesByCategory',
    'selectedClassId',
])

<div x-data="{ details: false }">
    @foreach($classesByCategory as $category => $items)
        <div class="mt-7">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="font-semibold text-bronze-800">{{ $category }}</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 items-center gap-4">
                @foreach($items as $klass)
                    <x-choice-card
                        name="playable_class_id"
                        :value="$klass->id"
                        :title="$klass->title"
                        :image="$klass->image_path ? asset($klass->image_path) : null"
                        model="selectedClassId"
                    >
                        <x-button
                            variant="secondary"
                            size="sm"
                            @click.stop="details = {{ Js::from($klass) }}"
                        >
                            Détails
                        </x-button>
                    </x-choice-card>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Modal Détails --}}
    <x-modal show="details" :title="'Détails'">
        <div class="space-y-4">
            <template x-if="details">
                <div>
                    <div class="aspect-16/7 rounded-xl overflow-hidden border border-sand-200 bg-sand-100">
                        <img :src="'/' + details.image_path" class="h-full w-full object-cover" alt="">
                    </div>

                    <div class="mt-4 text-lg font-semibold text-sand-900" x-text="details.title"></div>
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
                                @click="{{$selectedClassId}} = String(details.id); details = false"
                        >
                            Choisir
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </x-modal>
</div>
