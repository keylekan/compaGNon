@props([
    'classesByCategory',
    'selectedClassId',
    'openItem'
])

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
                        @click.stop="{{$openItem}} = {{ Js::from($klass) }}"
                    >
                        Détails
                    </x-button>
                </x-choice-card>
            @endforeach
        </div>
    </div>
@endforeach
