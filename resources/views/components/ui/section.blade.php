@props([
    'tone' => 'light',   {{-- light | cream | dark --}}
    'container' => true,
])

@php
    $bg = match ($tone) {
        'cream' => 'bg-khara-cream',
        'dark'  => 'bg-khara-slate-dark text-white',
        default => 'bg-khara-white-off',
    };
@endphp

<section {{ $attributes->merge(['class' => "section relative $bg"]) }}>
    @if ($container)
        <div class="section-container relative z-10">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</section>
