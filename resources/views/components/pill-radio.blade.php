@props([
  'name',
  'value',
  'model', // expression alpine ex: "gender"
])

<label class="cursor-pointer">
    <input type="radio" name="{{ $name }}" value="{{ $value }}" class="sr-only peer"
           x-model="{{ $model }}">
    <span class="inline-flex items-center rounded-xl border px-3 py-2 text-sm font-semibold
               border-sand-200 bg-white text-sand-700
               peer-checked:border-bronze-500 peer-checked:bg-bronze-500/10 peer-checked:text-bronze-800">
    {{ $slot }}
  </span>
</label>
