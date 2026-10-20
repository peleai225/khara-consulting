@extends('layouts.app')

@section('title', 'Programmes de formation — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Les programmes de formation Khara Consulting : leadership, gestion, entrepreneuriat, RH et compétences digitales, en présentiel ou à distance.')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">Programmes</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                Des formations qui <span class="text-accent">transforment</span>.
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                Conçues pour le terrain, animées par des experts, nos formations développent des compétences
                directement actionnables — pour vos équipes comme pour les porteurs de projet.
            </p>
        </div>
    </div>
</section>

{{-- ===================== DOMAINES ===================== --}}
<section class="section bg-khara-white-off">
    <div class="section-container">
        <div class="max-w-2xl">
            <x-ui.eyebrow class="kc-reveal">Domaines de formation</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-3xl md:text-4xl">Cinq grands axes de montée en compétences</h2>
        </div>
        @php
            $domainItems = ($domaines ?? collect())->isNotEmpty()
                ? $domaines->map(fn($d) => ['icon' => $d->icon ?: 'spark', 'title' => $d->title, 'desc' => $d->description])->all()
                : [
                    ['icon'=>'graduation','title'=>'Leadership & management','desc'=>'Encadrer, motiver et faire grandir ses équipes.'],
                    ['icon'=>'rocket','title'=>'Entrepreneuriat','desc'=>'Lancer, piloter et faire croître son activité.'],
                    ['icon'=>'users','title'=>'Ressources humaines','desc'=>'Recruter, évaluer et développer les talents.'],
                    ['icon'=>'chart','title'=>'Gestion & performance','desc'=>'Piloter son activité par les chiffres et les process.'],
                    ['icon'=>'spark','title'=>'Compétences digitales','desc'=>'Outils numériques et transformation digitale.'],
                    ['icon'=>'shield','title'=>'Soft skills','desc'=>'Communication, organisation et efficacité personnelle.'],
                ];
        @endphp
        <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($domainItems as $d)
                <div class="card-feature has-petal kc-reveal kc-reveal-{{ ($loop->index % 3) + 1 }}">
                    <x-brand.petal class="petal-watermark w-32 h-32 -right-6 -bottom-6" />
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-khara-red-50 text-khara-red mb-4">
                        <x-ui.icon :name="$d['icon']" class="w-7 h-7" />
                    </span>
                    <h3 class="text-xl mb-2">{{ $d['title'] }}</h3>
                    <p class="text-khara-gray-600 text-[15px]">{{ $d['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== FORMATS ===================== --}}
<section class="section bg-khara-cream">
    <div class="section-container">
        <div class="max-w-2xl">
            <x-ui.eyebrow tone="gold" class="kc-reveal">Formats</x-ui.eyebrow>
            <h2 class="kc-reveal kc-reveal-2 mt-4 text-3xl md:text-4xl">Des modalités adaptées à votre réalité</h2>
        </div>
        @php
            $formatItems = ($formats ?? collect())->isNotEmpty()
                ? $formats->map(fn($f) => ['title' => $f->title, 'desc' => $f->description])->all()
                : [
                    ['title'=>'Intra-entreprise','desc'=>'Sur mesure, dans vos locaux, pour vos équipes.'],
                    ['title'=>'Inter-entreprises','desc'=>"En session ouverte, pour monter en compétences avec d'autres professionnels."],
                    ['title'=>'À distance','desc'=>"En ligne, où que vous soyez, avec le même niveau d'exigence."],
                ];
        @endphp
        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @foreach ($formatItems as $f)
                <div class="kc-reveal kc-reveal-{{ $loop->iteration }} bg-white rounded-[var(--radius-kc-lg)] p-8 border border-khara-gray-200">
                    <h3 class="text-xl mb-2">{{ $f['title'] }}</h3>
                    <p class="text-khara-gray-600">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
        <p class="mt-8 text-sm text-khara-gray-500">[À REMPLACER : calendrier des prochaines sessions, durées, tarifs et modalités d'inscription.]</p>
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="section-sm bg-khara-white-off">
    <div class="section-container">
        <div class="relative overflow-hidden rounded-[2.5rem] bg-khara-red px-8 py-14 md:p-16 text-center">
            <x-brand.petal class="petal-watermark w-[26rem] h-[26rem] -right-20 -top-20 text-white opacity-[0.08]" />
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl text-white kc-reveal">Formez vos équipes avec Khara</h2>
                <p class="mt-5 text-lg text-white/85 kc-reveal kc-reveal-2">Parlez-nous de vos besoins : nous construisons le programme qui vous ressemble.</p>
                <div class="mt-8 kc-reveal kc-reveal-3">
                    <x-ui.button :href="route('contact')" variant="gold" class="!px-8 !py-4">Demander un programme sur mesure</x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
