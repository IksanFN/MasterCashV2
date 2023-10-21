@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link fw-bold text-dark'
            : 'nav-link';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>