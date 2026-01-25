@props([
    'selectedClassId',
    'openItem'
])

{{-- Modal Détails --}}
<x-modal show="{{$openItem}}" :title="'Détails'">
    <div class="space-y-4">
        <template x-if="{{$openItem}}">
            <div>
                <div class="aspect-16/7 rounded-xl overflow-hidden border border-sand-200 bg-sand-100">
                    <img :src="'/' + {{$openItem}}.image_path" class="h-full w-full object-cover" alt="">
                </div>

                <div class="mt-4 text-lg font-semibold text-sand-900" x-text="{{$openItem}}.title"></div>
                <x-markdown class="mt-2 text-sm text-sand-800"  value="{{$openItem}}.description || '—'" />

                <div class="mt-5 flex justify-end gap-3">
                    <x-button @click="{{$openItem}} = false" variant="panel">
                        Fermer
                    </x-button>

                    <x-button
                        x-show="{{$selectedClassId}} != String({{$openItem}}.id)"
                        @click="{{$selectedClassId}} = String({{$openItem}}.id); {{$openItem}} = false"
                    >
                        Choisir
                    </x-button>
                </div>
            </div>
        </template>
    </div>
</x-modal>
