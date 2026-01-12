@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'p-2 border-2 bg-bronze-100 border-sand-500 focus:outline focus:outline-sand-700 focus:border-sand-700 rounded-lg shadow-sm']) }}>
