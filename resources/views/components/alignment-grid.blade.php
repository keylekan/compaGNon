@props([
  'name' => 'alignment',
  'model' => 'alignment',
])

@php
    $law = ['L' => 'Loyal', 'N' => 'Neutre', 'C' => 'Chaotique'];
    $mor = ['B' => 'Bon', 'N' => 'Neutre', 'M' => 'Mauvais'];
@endphp

<div class="grid grid-cols-3 gap-2">
    @foreach($law as $lCode => $lLabel)
        @foreach($mor as $mCode => $mLabel)
            @php $code = $lCode.$mCode; @endphp
            <label class="cursor-pointer">
                <input type="radio" name="{{ $name }}" value="{{ $code }}" class="sr-only" x-model="{{ $model }}">
                <div class="rounded-xl border p-3 bg-white transition
                    border-sand-200 hover:bg-sand-50"
                     :class="{{ $model }} === '{{ $code }}' ? 'border-gold-500 ring-1 ring-gold-500/30 bg-gold-500/10' : ''">
                    <div class="font-medium text-sand-800">{{ $lLabel }}</div>
                    <div class="font-semibold text-bronze-600">{{ $mLabel }}</div>
                </div>
            </label>
        @endforeach
    @endforeach
</div>
