@extends('layouts.app')

@section('title', 'Politique de confidentialité — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Comment Khara Consulting collecte et protège vos données personnelles.')

@section('content')
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-14 md:py-20">
        <x-ui.eyebrow>Vos données</x-ui.eyebrow>
        <h1 class="mt-4 text-4xl sm:text-5xl text-khara-slate">Politique de confidentialité</h1>
    </div>
</section>

<section class="section bg-khara-white-off">
    <div class="section-container max-w-3xl space-y-10 text-khara-gray-700 leading-relaxed">
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Données que nous collectons</h2>
            <p>Lorsque vous utilisez notre formulaire de contact, nous collectons les informations que vous nous transmettez : nom, email, téléphone, profil, besoins et message. Ces données servent uniquement à traiter votre demande.</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Utilisation des données</h2>
            <p>Vos données sont utilisées pour répondre à votre demande et, si vous l'avez accepté, pour vous recontacter au sujet de nos services. Elles ne sont jamais vendues à des tiers.</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Conservation</h2>
            <p class="text-khara-gray-400">[À REMPLACER : durée de conservation des données.]</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Vos droits</h2>
            <p>Vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour l'exercer, <a href="{{ route('contact') }}" class="text-khara-red font-semibold link-underline">écrivez-nous</a>@if(!empty($siteEmail)) à {{ $siteEmail }}@endif.</p>
        </div>
        <div>
            <h2 class="text-2xl text-khara-slate mb-3">Cookies</h2>
            <p class="text-khara-gray-400">[À REMPLACER : préciser les cookies utilisés le cas échéant (mesure d'audience, etc.).]</p>
        </div>
    </div>
</section>
@endsection
