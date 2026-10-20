@extends('layouts.app')

@section('title', 'Nos services — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Formation, accompagnement entrepreneurial, RH, structuration, audit et transformation : découvrez les expertises de Khara Consulting.')

@section('content')

{{-- ===================== PAGE HERO ===================== --}}
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">Nos expertises</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                Un partenaire unique, <span class="text-accent">six leviers</span> de croissance.
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                De la montée en compétences de vos équipes à la transformation de votre organisation,
                nous couvrons toute la chaîne de valeur du développement humain et entrepreneurial.
            </p>
        </div>
    </div>
</section>

{{-- ===================== LISTE DES SERVICES ===================== --}}
<section class="section bg-khara-white-off">
    <div class="section-container">
        @if ($services->isNotEmpty())
            <div class="space-y-6">
                @foreach ($services as $service)
                    <article id="{{ $service->slug }}"
                             class="card-feature has-petal scroll-mt-28 kc-reveal grid lg:grid-cols-[auto_1fr_auto] gap-6 lg:gap-10 items-start">
                        <x-brand.petal class="petal-watermark w-48 h-48 -right-10 -bottom-10" />

                        <span class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-khara-red-50 text-khara-red flex-shrink-0">
                            <x-ui.icon :name="$service->icon ?? 'spark'" class="w-8 h-8" />
                        </span>

                        <div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-2xl lg:text-3xl">{{ $service->title }}</h2>
                                <span class="badge badge-gold text-xs">0{{ $loop->iteration }}</span>
                            </div>
                            <p class="mt-3 text-khara-red font-semibold">{{ $service->description }}</p>
                            @if ($service->content)
                                <p class="mt-3 text-khara-gray-600 leading-relaxed max-w-3xl">{{ $service->content }}</p>
                            @endif
                        </div>

                        <div class="lg:pt-2">
                            <x-ui.button :href="route('contact')" variant="secondary" class="whitespace-nowrap">
                                Parler de ce besoin
                            </x-ui.button>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-khara-gray-500">[À REMPLACER : ajoutez des services depuis le back-office.]</p>
        @endif
    </div>
</section>

{{-- ===================== POURQUOI KHARA ===================== --}}
<section class="section bg-khara-slate-dark text-white relative overflow-hidden">
    <x-brand.petal class="petal-watermark w-[30rem] h-[30rem] -left-28 -top-24 opacity-[0.06]" />
    <div class="section-container relative z-10">
        <div class="max-w-2xl">
            <x-ui.eyebrow tone="gold" class="kc-reveal">Pourquoi Khara Consulting</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-3xl md:text-4xl text-white">Une exigence de résultats, un ancrage de terrain</h2>
        </div>
        @php
            $whyItems = ($why ?? collect())->isNotEmpty()
                ? $why->map(fn($b) => ['icon' => $b->icon ?: 'spark', 'title' => $b->title, 'desc' => $b->subtitle])->all()
                : [
                    ['icon'=>'shield','title'=>'Sur mesure, jamais sur étagère','desc'=>"Chaque mission part de votre contexte réel, pas d'un modèle générique."],
                    ['icon'=>'users','title'=>'À vos côtés, sur le terrain','desc'=>'Nous agissons avec vos équipes, pas seulement en salle de réunion.'],
                    ['icon'=>'chart','title'=>'Orientés impact','desc'=>"Nous mesurons les résultats et ancrons les acquis dans la durée."],
                ];
        @endphp
        <div class="mt-12 grid md:grid-cols-3 gap-8">
            @foreach ($whyItems as $w)
                <div class="kc-reveal kc-reveal-{{ $loop->iteration }}">
                    <span class="text-khara-gold"><x-ui.icon :name="$w['icon']" class="w-8 h-8" /></span>
                    <h3 class="text-xl mt-4 mb-2 text-white">{{ $w['title'] }}</h3>
                    <p class="text-white/60 leading-relaxed">{{ $w['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="section-sm bg-khara-white-off">
    <div class="section-container">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-khara-red px-8 py-14 md:p-16 text-center">
            <x-brand.petal class="petal-watermark w-[26rem] h-[26rem] -right-20 -top-20 text-white opacity-[0.08]" />
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl text-white kc-reveal">Un besoin précis en tête ?</h2>
                <p class="mt-5 text-lg text-white/85 kc-reveal kc-reveal-2">Décrivez-nous votre projet : nous revenons vers vous sous 24 h avec une approche adaptée.</p>
                <div class="mt-8 kc-reveal kc-reveal-3">
                    <x-ui.button :href="route('contact')" variant="gold" class="!px-8 !py-4">Demander un devis gratuit</x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
