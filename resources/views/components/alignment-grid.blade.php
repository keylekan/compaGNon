@props([
  'name' => 'alignment',
  'model' => 'alignment',
  'allowed' => null,
])

@php
    $law = ['L' => 'Loyal', 'N' => 'Neutre', 'C' => 'Chaotique'];
    $mor = ['B' => 'Bon', 'N' => 'Neutre', 'M' => 'Mauvais'];
@endphp

<div class="grid grid-cols-3 gap-2">
    @foreach($law as $lCode => $lLabel)
        @foreach($mor as $mCode => $mLabel)
            @php $code = $lCode.$mCode; @endphp
            <label
                class="cursor-pointer"
                x-data="{ disabled: false }"
                x-init="$watch('{{$allowed}}', allowed => disabled = allowed?.length ? !allowed.includes('{{$code}}') : false)"
            >
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $code }}"
                    class="sr-only"
                    x-model="{{ $model }}"
                    :disabled="disabled"
                >
                <div class="rounded-xl border p-3 bg-white transition
                    border-sand-200 hover:bg-sand-50"
                     :class="[
                         {{ $model }} === '{{ $code }}' ? 'border-gold-500 ring-1 ring-gold-500/30 bg-gold-500/10' : '',
                         disabled ? 'opacity-50 cursor-not-allowed' : ''
                     ]"
                >
                    <div class="font-medium text-sand-800">{{ $lLabel }}</div>
                    <div class="font-semibold text-bronze-600">{{ $mLabel }}</div>
                </div>
            </label>
        @endforeach
    @endforeach
</div>
