@extends('layouts.app')

@section('content')

{{-- ======================= HERO — Révélation éditoriale ======================= --}}
<section class="relative overflow-hidden bg-gradient-to-b from-khara-white-off via-khara-white-off to-khara-cream">
    {{-- Grand pétale de marque, discret --}}
    <x-brand.petal class="absolute -right-48 -top-40 w-[48rem] h-[48rem] text-khara-red opacity-[0.05] pointer-events-none select-none" />
    {{-- Lueur or --}}
    <div class="absolute top-20 -left-32 w-96 h-96 rounded-full bg-khara-gold/10 blur-3xl pointer-events-none"></div>

    <div class="section-container relative z-10 py-16 md:py-24 lg:py-28">
        <div class="grid lg:grid-cols-[1.05fr_0.95fr] gap-12 lg:gap-16 items-center">
            {{-- Texte (piloté par le premier slide actif, sinon valeurs par défaut) --}}
            <div class="max-w-xl">
                <x-ui.eyebrow class="kc-reveal">{{ $hero->badge_text ?? 'Formation · Conseil · Transformation' }}</x-ui.eyebrow>

                @if($hero && $hero->title)
                    <h1 class="kc-reveal kc-reveal-2 mt-6 text-[2.85rem] leading-[1.02] sm:text-6xl lg:text-[4.5rem] text-khara-slate">{!! $hero->title !!}</h1>
                @else
                    <h1 class="kc-reveal kc-reveal-2 mt-6 text-[2.85rem] leading-[1.02] sm:text-6xl lg:text-[4.5rem] text-khara-slate">
                        Révélez le <span class="relative text-accent whitespace-nowrap">plein potentiel<span class="absolute left-0 -bottom-1 h-[0.18em] w-full bg-khara-gold/50 rounded-full"></span></span> de vos talents.
                    </h1>
                @endif

                <p class="kc-reveal kc-reveal-3 mt-7 text-lg leading-relaxed text-khara-gray-600">
                    @if($hero && ($hero->subtitle || $hero->description))
                        {{ $hero->subtitle ?: $hero->description }}
                    @else
                        Khara Consulting forme, outille et propulse les entreprises et les entrepreneurs
                        d'Afrique francophone. Nous transformons votre potentiel en performance durable —
                        <span class="font-semibold text-khara-slate italic">beyond&nbsp;and&nbsp;further.</span>
                    @endif
                </p>

                <div class="kc-reveal kc-reveal-4 mt-9 flex flex-col sm:flex-row gap-4">
                    <x-ui.button :href="($hero->button_link ?? null) ?: route('contact')" variant="primary-lg">
                        {{ $hero->button_text ?? 'Demander un devis gratuit' }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </x-ui.button>
                    <x-ui.button :href="($hero->button_link_2 ?? null) ?: route('services')" variant="secondary">{{ $hero->button_text_2 ?? 'Découvrir nos services' }}</x-ui.button>
                </div>

                {{-- Valeurs de marque --}}
                <div class="kc-reveal kc-reveal-5 mt-10 pt-8 border-t border-khara-gray-200/70 flex flex-wrap items-center gap-x-8 gap-y-3 text-sm font-semibold text-khara-slate">
                    @foreach (['Excellence', 'Innovation', 'Impact'] as $value)
                        <span class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-khara-gold"></span>{{ $value }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Visuel : photo + ondes KC --}}
            <div class="relative kc-reveal kc-reveal-2">
                {{-- Ondes KC animées, émanant derrière la photo --}}
                <x-brand.arcs class="absolute -left-10 lg:-left-16 top-1/2 -translate-y-1/2 w-56 h-56 lg:w-72 lg:h-72 text-khara-red/70 z-0" />

                <div class="relative mx-auto max-w-md lg:max-w-none">
                    {{-- Accent or derrière --}}
                    <div class="absolute -top-6 -right-6 w-32 h-32 rounded-[2rem] bg-khara-gold/20 z-0 hidden lg:block"></div>

                    {{-- cadre pétale : 3 coins arrondis, 1 coin net (bas-gauche) --}}
                    <div class="relative z-10 overflow-hidden rounded-[3rem] rounded-bl-none shadow-[0_50px_90px_-30px_rgba(183,6,6,0.4)] ring-1 ring-black/5">
                        <img src="{{ ($hero && $hero->image) ? asset('storage/' . $hero->image) : asset('images/hero/1.jpg') }}"
                             alt="Accompagnement et conseil — Khara Consulting"
                             width="1000" height="750"
                             class="w-full h-[26rem] lg:h-[34rem] object-cover"
                             fetchpriority="high" decoding="async">
                        {{-- voile dégradé bas pour ancrer la carte --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-khara-slate-darker/25 via-transparent to-transparent"></div>
                    </div>

                    {{-- Carte flottante : signature --}}
                    <div class="absolute z-20 -bottom-7 -left-5 sm:-left-7 bg-white rounded-2xl shadow-[var(--shadow-kc-lg)] px-6 py-5 border border-khara-gray-100 flex items-center gap-4">
                        <x-brand.petal class="w-11 h-11 text-khara-red flex-shrink-0" />
                        <div>
                            <p class="font-display font-bold text-khara-slate leading-tight text-lg">{{ $siteSlogan ?? 'Beyond and Further' }}</p>
                            <p class="text-xs text-khara-gray-500 mt-0.5">Votre partenaire de croissance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================= BANDE DE PREUVE ======================= --}}
<section class="bg-khara-slate-dark text-white">
    <div class="section-container py-10">
        @php
            $pillarItems = ($pillars ?? collect())->isNotEmpty()
                ? $pillars->map(fn($b) => ['icon' => $b->icon ?: 'spark', 'title' => $b->title, 'desc' => $b->subtitle])->all()
                : [
                    ['icon'=>'graduation','title'=>'Formations terrain','desc'=>'Des compétences directement actionnables.'],
                    ['icon'=>'rocket','title'=>"De l'idée à l'impact",'desc'=>'Un accompagnement de bout en bout.'],
                    ['icon'=>'chart','title'=>'Croissance maîtrisée','desc'=>'Des organisations qui tiennent dans le temps.'],
                    ['icon'=>'shield','title'=>'Ancrage africain','desc'=>"Une expertise au plus près de vos réalités."],
                ];
        @endphp
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($pillarItems as $p)
                <div class="kc-reveal kc-reveal-{{ $loop->iteration }} flex flex-col gap-2">
                    <span class="text-khara-gold"><x-ui.icon :name="$p['icon']" class="w-7 h-7" /></span>
                    <p class="font-display font-bold text-lg text-white">{{ $p['title'] }}</p>
                    <p class="text-sm text-white/60">{{ $p['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= CHIFFRES CLÉS ======================= --}}
@if(($stats ?? collect())->isNotEmpty())
<section class="bg-khara-white-off border-b border-khara-gray-100">
    <div class="section-container py-12 md:py-16">
        <div class="flex flex-wrap justify-center gap-x-12 lg:gap-x-24 gap-y-8">
            @foreach($stats as $s)
                <x-ui.stat :value="$s->value" :label="$s->label" class="kc-reveal kc-reveal-{{ $loop->iteration }}" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ======================= SERVICES ======================= --}}
<section class="section bg-khara-white-off relative overflow-hidden">
    <div class="section-container relative z-10">
        <div class="max-w-2xl">
            <x-ui.eyebrow class="kc-reveal">Nos expertises</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-4xl md:text-5xl">Un partenaire unique pour chaque étape de votre développement</h2>
        </div>

        @if ($services->isNotEmpty())
            <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $service)
                    <a href="{{ route('services') }}#{{ $service->slug }}"
                       class="card-feature has-petal group kc-reveal kc-reveal-{{ ($loop->index % 3) + 1 }}">
                        <x-brand.petal class="petal-watermark w-36 h-36 -right-6 -bottom-6" />
                        <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-khara-red-50 text-khara-red mb-5 group-hover:bg-khara-red group-hover:text-white transition-colors">
                            <x-ui.icon :name="$service->icon ?? 'spark'" class="w-7 h-7" />
                        </span>
                        <h3 class="text-2xl mb-3">{{ $service->title }}</h3>
                        <p class="text-khara-gray-600 leading-relaxed">{{ $service->description }}</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-khara-red font-semibold text-sm">
                            En savoir plus
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <p class="mt-12 text-khara-gray-500">[À REMPLACER : aucun service actif — ajoutez-en depuis le back-office]</p>
        @endif
    </div>
</section>

{{-- ======================= MÉTHODE ======================= --}}
<section class="section bg-khara-cream">
    <div class="section-container">
        <div class="max-w-2xl">
            <x-ui.eyebrow tone="gold" class="kc-reveal">Notre méthode</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-4xl md:text-5xl">Une démarche claire, du diagnostic aux résultats</h2>
        </div>

        @php
            $stepItems = ($methodSteps ?? collect())->isNotEmpty()
                ? $methodSteps->map(fn($b) => ['title' => $b->title, 'desc' => $b->subtitle])->all()
                : [
                    ['title'=>'Écoute & diagnostic','desc'=>'Nous comprenons votre contexte, vos enjeux et vos objectifs réels.'],
                    ['title'=>'Stratégie sur mesure','desc'=>"Nous concevons un plan d'action priorisé, adapté à vos moyens."],
                    ['title'=>'Mise en œuvre','desc'=>'Nous agissons à vos côtés, sur le terrain, avec vos équipes.'],
                    ['title'=>'Suivi & résultats','desc'=>"Nous mesurons l'impact et ancrons les acquis dans la durée."],
                ];
        @endphp
        <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($stepItems as $step)
                <div class="relative kc-reveal kc-reveal-{{ $loop->iteration }}">
                    <span class="font-display text-5xl font-bold text-khara-red/15">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="text-xl mt-2 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-khara-gray-600 text-[15px] leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================= RÉALISATIONS ======================= --}}
<section class="section bg-khara-white-off">
    <div class="section-container">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div class="max-w-xl">
                <x-ui.eyebrow class="kc-reveal">Réalisations</x-ui.eyebrow>
                <h2 class="kc-reveal kc-reveal-2 mt-4 text-4xl md:text-5xl">Des résultats concrets pour nos clients</h2>
            </div>
            <x-ui.button :href="route('contact')" variant="secondary" class="kc-reveal">Discuter de votre projet</x-ui.button>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @forelse (($realisations ?? collect()) as $r)
                <a href="{{ route('realisations') }}#{{ $r->slug }}" class="card group kc-reveal kc-reveal-{{ $loop->iteration }}">
                    <div class="aspect-[4/3] rounded-xl overflow-hidden bg-khara-gray-100 flex items-center justify-center mb-5">
                        @if($r->image)
                            <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="w-full h-full object-cover" loading="lazy">
                        @else
                            <x-brand.petal class="w-14 h-14 text-khara-gray-300" />
                        @endif
                    </div>
                    @if($r->sector)<span class="badge badge-gold mb-3">{{ $r->sector }}</span>@endif
                    <h3 class="text-xl mb-2 group-hover:text-khara-red transition-colors">{{ $r->title }}</h3>
                    <p class="text-khara-gray-600 text-[15px]">{{ Str::limit($r->summary, 120) }}</p>
                </a>
            @empty
                @for ($i = 1; $i <= 3; $i++)
                    <div class="card kc-reveal kc-reveal-{{ $i }}">
                        <div class="aspect-[4/3] rounded-xl bg-khara-gray-100 flex items-center justify-center mb-5">
                            <x-brand.petal class="w-14 h-14 text-khara-gray-300" />
                        </div>
                        <span class="badge badge-gold mb-3">[À REMPLACER : secteur]</span>
                        <h3 class="text-xl mb-2">[À REMPLACER : étude de cas #{{ $i }}]</h3>
                        <p class="text-khara-gray-600 text-[15px]">[À REMPLACER : contexte, défi, solution et résultat. Ajoutez vos réalisations depuis le back-office.]</p>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- ======================= TÉMOIGNAGES ======================= --}}
<section class="section bg-khara-slate-dark text-white relative overflow-hidden">
    <x-brand.petal class="petal-watermark w-[32rem] h-[32rem] -left-32 -bottom-32 opacity-[0.06]" />
    <div class="section-container relative z-10">
        <div class="max-w-2xl">
            <x-ui.eyebrow tone="gold" class="kc-reveal">Ils nous font confiance</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-4xl md:text-5xl text-white">La parole à nos clients</h2>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @if ($testimonials->isNotEmpty())
                @foreach ($testimonials as $t)
                    <figure class="bg-white/5 border border-white/10 rounded-[var(--radius-kc-lg)] p-8 kc-reveal kc-reveal-{{ ($loop->index % 3) + 1 }}">
                        <div class="flex gap-1 text-khara-gold mb-4">
                            @for ($s = 0; $s < ($t->rating ?? 5); $s++)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-white/80 leading-relaxed">« {{ $t->testimonial }} »</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3">
                            @if($t->photo)
                                <img src="{{ asset('storage/' . $t->photo) }}" alt="{{ $t->name }}" class="w-11 h-11 rounded-full object-cover" width="44" height="44">
                            @else
                                <span class="w-11 h-11 rounded-full bg-khara-red flex items-center justify-center text-white font-bold">{{ mb_substr($t->name, 0, 1) }}</span>
                            @endif
                            <span>
                                <span class="block font-semibold text-white">{{ $t->name }}</span>
                                <span class="block text-sm text-white/50">{{ $t->position }}@if($t->company), {{ $t->company }}@endif</span>
                            </span>
                        </figcaption>
                    </figure>
                @endforeach
            @else
                @for ($i = 1; $i <= 3; $i++)
                    <figure class="bg-white/5 border border-white/10 rounded-[var(--radius-kc-lg)] p-8 kc-reveal kc-reveal-{{ $i }}">
                        <div class="flex gap-1 text-khara-gold/40 mb-4">
                            @for ($s = 0; $s < 5; $s++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>@endfor
                        </div>
                        <blockquote class="text-white/50 leading-relaxed">« [À REMPLACER : témoignage client authentique #{{ $i }} — nom, fonction, entreprise.] »</blockquote>
                        <figcaption class="mt-5 flex items-center gap-3">
                            <span class="w-11 h-11 rounded-full bg-white/10"></span>
                            <span class="text-sm text-white/40">[À REMPLACER : nom &amp; fonction]</span>
                        </figcaption>
                    </figure>
                @endfor
            @endif
        </div>
    </div>
</section>

{{-- ======================= CTA FINAL ======================= --}}
<section class="section-sm bg-khara-white-off">
    <div class="section-container">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-khara-red px-8 py-14 md:p-16 text-center">
            <x-brand.petal class="petal-watermark w-[28rem] h-[28rem] -right-24 -top-24 text-white opacity-[0.08]" />
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-5xl text-white kc-reveal">Parlons de votre projet.</h2>
                <p class="mt-5 text-lg text-white/85 kc-reveal kc-reveal-2">
                    Un premier échange gratuit pour comprendre vos besoins et vous proposer la meilleure approche.
                </p>
                <div class="mt-9 flex flex-col sm:flex-row gap-4 justify-center kc-reveal kc-reveal-3">
                    <x-ui.button :href="route('contact')" variant="gold" class="!px-8 !py-4">Demander un devis gratuit</x-ui.button>
                    @if(!empty($siteWhatsapp))
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteWhatsapp) }}" target="_blank" rel="noopener noreferrer" class="btn-outline !px-8 !py-4">
                            Écrire sur WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
