@extends('layouts.app')

@section('title', ($page->meta_title ?? null) ?: 'À propos — ' . ($siteName ?? 'Khara Consulting'))
@section('description', ($page->meta_description ?? null) ?: 'Khara Consulting : notre mission, notre vision et nos valeurs au service des talents et des entreprises d\'Afrique francophone.')

@section('content')

@php
    $values = ($page->values ?? null) ?: ['Excellence', 'Innovation', 'Éthique', 'Impact social'];
    $valueDesc = [
        'Excellence' => 'Un niveau d\'exigence élevé, de la première rencontre aux résultats.',
        'Innovation' => 'Des méthodes modernes, adaptées aux réalités du terrain.',
        'Éthique' => 'Transparence, honnêteté et respect de vos intérêts.',
        'Impact social' => 'Faire grandir les talents et contribuer au développement du continent.',
    ];
@endphp

{{-- ===================== HERO ===================== --}}
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">À propos</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                {!! ($page->hero_title ?? null) ?: 'Révéler le potentiel, <span class="text-accent">au-delà des frontières</span>.' !!}
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                {{ ($page->hero_subtitle ?? null) ?: 'Khara Consulting est né d\'une conviction : l\'Afrique francophone regorge de talents et d\'entreprises prêts à passer un cap. Notre rôle est de les former, de les outiller et de les propulser — beyond and further.' }}
            </p>
        </div>
    </div>
</section>

{{-- ===================== MISSION / VISION ===================== --}}
<section class="section bg-khara-white-off">
    <div class="section-container grid md:grid-cols-2 gap-6">
        <x-ui.card feature petal class="kc-reveal">
            <x-ui.eyebrow>Notre mission</x-ui.eyebrow>
            <p class="mt-4 text-xl leading-relaxed text-khara-slate">
                {{ ($page->mission ?? null) ?: 'Accompagner les entreprises et les entrepreneurs d\'Afrique francophone dans leur montée en compétences, leur structuration et leur croissance, avec méthode, exigence et proximité.' }}
            </p>
        </x-ui.card>
        <x-ui.card feature petal class="kc-reveal kc-reveal-2">
            <x-ui.eyebrow tone="gold">Notre vision</x-ui.eyebrow>
            <p class="mt-4 text-xl leading-relaxed text-khara-slate">
                {{ ($page->vision ?? null) ?: 'Un continent où chaque talent et chaque organisation dispose des outils pour exprimer son plein potentiel et aller au-delà de ses limites.' }}
            </p>
        </x-ui.card>
    </div>
</section>

{{-- ===================== VALEURS ===================== --}}
<section class="section bg-khara-slate-dark text-white relative overflow-hidden">
    <x-brand.petal class="petal-watermark w-[30rem] h-[30rem] -right-28 -bottom-24 opacity-[0.06]" />
    <div class="section-container relative z-10">
        <div class="max-w-2xl">
            <x-ui.eyebrow tone="gold" class="kc-reveal">Nos valeurs</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-3xl md:text-4xl text-white">Ce qui guide chacune de nos missions</h2>
        </div>
        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($values as $value)
                <div class="kc-reveal kc-reveal-{{ $loop->iteration }} p-6 rounded-[var(--radius-kc-lg)] bg-white/5 border border-white/10">
                    <span class="font-display text-4xl font-bold text-khara-gold">0{{ $loop->iteration }}</span>
                    <h3 class="text-lg mt-3 mb-2 text-white">{{ $value }}</h3>
                    <p class="text-sm text-white/60 leading-relaxed">{{ $valueDesc[$value] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== ÉQUIPE (placeholder) ===================== --}}
<section class="section bg-khara-white-off">
    <div class="section-container">
        <div class="max-w-2xl">
            <x-ui.eyebrow class="kc-reveal">L'équipe</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-3xl md:text-4xl">Des experts à vos côtés</h2>
            <p class="kc-reveal kc-reveal-3 mt-4 text-khara-gray-600">Des consultants expérimentés et engagés, au plus près de vos réalités.</p>
        </div>
        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($team as $member)
                <div class="card kc-reveal kc-reveal-{{ ($loop->index % 4) + 1 }} text-center">
                    <div class="w-24 h-24 mx-auto rounded-full overflow-hidden bg-khara-gray-100 flex items-center justify-center mb-4">
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover" loading="lazy">
                        @else
                            <span class="text-2xl font-display font-bold text-khara-red">{{ mb_substr($member->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <h3 class="text-lg">{{ $member->name }}</h3>
                    @if($member->role)<p class="text-sm text-khara-red font-semibold">{{ $member->role }}</p>@endif
                    @if($member->bio)<p class="mt-2 text-sm text-khara-gray-500">{{ $member->bio }}</p>@endif
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-4 text-khara-gray-500">
                    [À REMPLACER : ajoutez les membres de l'équipe depuis le back-office (menu « Équipe »).]
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="section-sm bg-khara-cream">
    <div class="section-container text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl kc-reveal">Travaillons ensemble</h2>
        <p class="mt-4 text-lg text-khara-gray-600 kc-reveal kc-reveal-2">Vous partagez notre exigence ? Parlons de la façon dont nous pouvons vous accompagner.</p>
        <div class="mt-8 kc-reveal kc-reveal-3">
            <x-ui.button :href="route('contact')" variant="primary-lg">Demander un devis gratuit</x-ui.button>
        </div>
    </div>
</section>

@endsection
