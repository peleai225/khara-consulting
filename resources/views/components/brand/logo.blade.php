@props([
    'linked' => true,
    'chip'   => false,   {{-- true : pose le logo sur une pastille blanche (fonds sombres) --}}
    'height' => 'h-11',  {{-- hauteur Tailwind --}}
])

@php
    $src = (! empty($siteLogo ?? null))
        ? asset('storage/' . $siteLogo)
        : asset('brand/khara-logo.png');
    $alt = ($siteName ?? 'Khara Consulting') . ' — logo';
@endphp

@php
    $img = '<img src="' . e($src) . '" alt="' . e($alt) . '" class="' . e($height) . ' w-auto object-contain" width="320" height="120" loading="eager" decoding="async">';
    $wrap = $chip
        ? '<span class="inline-flex items-center justify-center bg-white rounded-xl px-3 py-2">' . $img . '</span>'
        : $img;
@endphp

@if ($linked)
    <a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-flex items-center group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-khara-red/50 rounded-xl']) }}
       aria-label="{{ $siteName ?? 'Khara Consulting' }} — accueil">
        {!! $wrap !!}
    </a>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center']) }}>{!! $wrap !!}</span>
@endif
