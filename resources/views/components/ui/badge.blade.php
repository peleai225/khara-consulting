@props(['tone' => 'red'])

@php
    $classes = match ($tone) {
        'gold' => 'badge badge-gold',
        'ink'  => 'badge badge-ink',
        default => 'badge badge-red',
    };
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
