@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-yellow-400 text-white'
            : 'text-gray-200 hover:bg-orange-300 hover:text-white';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
