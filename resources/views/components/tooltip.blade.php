@props([
  'text',
])

<span {{$attributes->class('has-tooltip')}}>
    {{ $slot }}<!--
 --><sup class="ml-0.5">?</sup><!--
 --><span class="tooltip rounded shadow-lg p-1 bg-sand-50 text-xs text-sand-800 -mt-8 top-0 left-1/2 -translate-x-1/2 w-max">
        {{ $text }}
    </span><!--
--></span>
