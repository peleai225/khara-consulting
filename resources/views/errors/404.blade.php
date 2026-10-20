@extends('layouts.app')

@section('title', 'Page introuvable — ' . ($siteName ?? 'Khara Consulting'))

@section('content')
<section class="relative overflow-hidden bg-khara-white-off">
    <x-brand.petal class="absolute -right-40 -top-32 w-[42rem] h-[42rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-24 md:py-32 text-center max-w-2xl mx-auto">
        <div class="flex justify-center mb-6">
            <x-brand.arcs class="w-28 h-28 text-khara-red/70" />
        </div>
        <p class="font-display text-7xl md:text-8xl font-bold text-khara-red">404</p>
        <h1 class="mt-4 text-3xl md:text-4xl text-khara-slate">Cette page est introuvable</h1>
        <p class="mt-5 text-lg text-khara-gray-600">La page que vous cherchez a peut-être été déplacée ou n'existe plus.</p>
        <div class="mt-9 flex flex-col sm:flex-row gap-4 justify-center">
            <x-ui.button :href="route('home')" variant="primary">Retour à l'accueil</x-ui.button>
            <x-ui.button :href="route('contact')" variant="secondary">Nous contacter</x-ui.button>
        </div>
    </div>
</section>
@endsection
