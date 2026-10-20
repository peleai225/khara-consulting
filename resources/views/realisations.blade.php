@extends('layouts.app')

@section('title', 'Réalisations — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Études de cas et résultats concrets obtenus par Khara Consulting pour ses clients.')

@section('content')

<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">Réalisations</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                Des résultats <span class="text-accent">concrets</span>, pas des promesses.
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                Chaque mission est une histoire : un défi, une approche sur mesure, des résultats mesurables.
            </p>
        </div>
    </div>
</section>

<section class="section bg-khara-white-off">
    <div class="section-container">
        @if($realisations->isNotEmpty())
            <div class="space-y-16">
                @foreach($realisations as $r)
                    <article id="{{ $r->slug }}" class="scroll-mt-28 grid lg:grid-cols-2 gap-10 items-center kc-reveal {{ $loop->odd ? '' : 'lg:[&>*:first-child]:order-2' }}">
                        <div class="overflow-hidden rounded-[2.5rem] rounded-bl-none shadow-[var(--shadow-kc-lg)]">
                            @if($r->image)
                                <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="w-full h-72 lg:h-96 object-cover" loading="lazy">
                            @else
                                <div class="w-full h-72 lg:h-96 bg-khara-gray-100 flex items-center justify-center"><x-brand.petal class="w-20 h-20 text-khara-gray-300" /></div>
                            @endif
                        </div>
                        <div>
                            @if($r->sector)<x-ui.badge tone="gold">{{ $r->sector }}</x-ui.badge>@endif
                            <h2 class="text-3xl mt-4 mb-4">{{ $r->title }}</h2>
                            @if($r->summary)<p class="text-khara-gray-600 leading-relaxed mb-5">{{ $r->summary }}</p>@endif
                            <div class="space-y-4">
                                @foreach(['challenge' => 'Le défi', 'solution' => 'La solution', 'result' => 'Les résultats'] as $field => $label)
                                    @if($r->$field)
                                        <div class="flex gap-3">
                                            <span class="kc-check mt-0.5 flex-shrink-0"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></span>
                                            <div><span class="font-semibold text-khara-slate">{{ $label }} — </span><span class="text-khara-gray-600">{{ $r->$field }}</span></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center max-w-xl mx-auto py-10">
                <x-brand.petal class="w-16 h-16 text-khara-gray-200 mx-auto mb-5" />
                <h2 class="text-2xl mb-3">Nos études de cas arrivent bientôt</h2>
                <p class="text-khara-gray-600">[À REMPLACER : ajoutez vos réalisations depuis le back-office pour les afficher ici.]</p>
                <div class="mt-6"><x-ui.button :href="route('contact')" variant="primary">Discuter de votre projet</x-ui.button></div>
            </div>
        @endif
    </div>
</section>

<section class="section-sm bg-khara-cream">
    <div class="section-container text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl kc-reveal">Votre projet, notre prochaine réussite</h2>
        <p class="mt-4 text-lg text-khara-gray-600 kc-reveal kc-reveal-2">Parlons de vos objectifs et construisons ensemble des résultats mesurables.</p>
        <div class="mt-8 kc-reveal kc-reveal-3"><x-ui.button :href="route('contact')" variant="primary-lg">Demander un devis gratuit</x-ui.button></div>
    </div>
</section>

@endsection
