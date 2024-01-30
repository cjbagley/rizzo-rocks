@props(['active'])

@php
$classes = ($active ?? false) ? 'active' : '';
@endphp

<a {{ $attributes->merge(['class' => 'nav-link $classes']) }}>
    {{ $slot }}
</a>