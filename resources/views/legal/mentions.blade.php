@extends('layouts.app')

@section('title', 'Mentions légales — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Mentions légales de Khara Consulting.')

@section('content')
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-14 md:py-20">
        <x-ui.eyebrow>Informations légales</x-ui.eyebrow>
        <h1 class="mt-4 text-4xl sm:text-5xl text-khara-slate">Mentions légales</h1>
    </div>
</section>

<section class="section bg-khara-white-off">
    <div class="section-container max-w-3xl space-y-10 text-khara-gray-700 leading-relaxed">
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Éditeur du site</h2>
            <p>{{ $siteName ?? 'Khara Consulting' }}{{ !empty($siteAddress) ? ' — ' . $siteAddress : '' }}.</p>
            <p>
                @if(!empty($sitePhone)) Téléphone : {{ $sitePhone }}. @endif
                @if(!empty($siteEmail)) Email : {{ $siteEmail }}. @endif
            </p>
            <p class="text-khara-gray-400">[À REMPLACER : forme juridique, capital, numéro d'immatriculation (RCCM), représentant légal.]</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Hébergement</h2>
            <p class="text-khara-gray-400">[À REMPLACER : nom et coordonnées de l'hébergeur.]</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Propriété intellectuelle</h2>
            <p>L'ensemble des contenus de ce site (textes, visuels, logo) est la propriété de {{ $siteName ?? 'Khara Consulting' }}, sauf mention contraire. Toute reproduction sans autorisation est interdite.</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Contact</h2>
            <p>Pour toute question, <a href="{{ route('contact') }}" class="text-khara-red font-semibold link-underline">contactez-nous</a>.</p>
        </div>
    </div>
</section>
@endsection
