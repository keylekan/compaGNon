@props([
  'step' => 1,
  'steps' => [
    1 => 'Race',
    2 => 'Classe',
    3 => 'Dieu',
    4 => 'Identité',
    5 => 'Résumé',
  ],
])

<div class="flex items-center justify-between gap-3">
    @foreach($steps as $i => $label)
        <div class="flex items-center gap-3 min-w-0">
            <div
                class="h-9 w-9 shrink-0 rounded-full border flex items-center justify-center font-semibold"
                x-bind:class="step >= {{$i}} ? 'border-bronze-500 bg-bronze-500/15 text-bronze-700' : 'border-sand-300 bg-sand-50 text-sand-500'">
                {{ $i }}
            </div>
            <div class="min-w-0">
                <div
                    class="text-sm font-semibold truncate"
                    x-bind:class="step >= {{$i}} ? 'text-sand-900' : 'text-sand-500'"
                >
                    {{ $label }}
                </div>
                <div class="h-1 mt-1 rounded bg-sand-200 overflow-hidden">
                    <div class="h-full" x-bind:class="step > {{$i}} ? 'w-full bg-bronze-500' : (step === {{$i}} ? 'w-1/2 bg-bronze-400' : 'w-0')"></div>
                </div>
            </div>
        </div>

        @if(!$loop->last)
            <div class="hidden md:block h-px flex-1 bg-sand-200"></div>
        @endif
    @endforeach
</div>
