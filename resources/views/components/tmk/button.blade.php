@props([
    'activated' => false,
    'orange' => false,
    'href' => null
])

@php
$color = $orange ? 'orange' : 'blue';
@endphp

<a @if($href) href="{{ $href }}" @endif>
    <button
        {{ $attributes }}
        class="{{ $activated ? "bg-white border-tm-$color text-tm-$color" : "bg-tm-$color hover:bg-tm-darker-$color border-tm-darker-$color text-white" }} border-2 transition font-bold py-2 px-4 rounded mb-2">
        {{ $slot }}
    </button>
</a>
