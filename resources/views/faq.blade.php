@extends('layouts.app')

@section('title', 'FAQ — ' . ($siteName ?? 'Khara Consulting'))
@section('description', 'Questions fréquentes sur les services, le déroulement des missions et les modalités de Khara Consulting.')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">FAQ</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                Vos questions, <span class="text-accent">nos réponses</span>.
            </h1>
            <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">
                Tout ce qu'il faut savoir avant de nous confier votre projet. Une autre question ? Écrivez-nous.
            </p>
        </div>
    </div>
</section>

<section class="section bg-khara-white-off">
    <div class="section-container max-w-3xl">
        @forelse ($faqsByCategory as $category => $items)
            <div class="mb-12 last:mb-0">
                <h2 class="text-2xl mb-5 flex items-center gap-3">
                    <span class="w-6 h-0.5 bg-khara-red rounded-full"></span>{{ $category ?: 'Général' }}
                </h2>
                <div class="space-y-3">
                    @foreach ($items as $faq)
                        <details class="group card !p-0 overflow-hidden kc-reveal">
                            <summary class="flex items-center justify-between gap-4 cursor-pointer list-none px-6 py-5 font-semibold text-khara-slate hover:text-khara-red transition-colors">
                                <span>{{ $faq->question }}</span>
                                <svg class="w-5 h-5 flex-shrink-0 text-khara-red transition-transform duration-300 group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                            </summary>
                            <div class="px-6 pb-6 -mt-1 text-khara-gray-600 leading-relaxed">{{ $faq->answer }}</div>
                        </details>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-khara-gray-500">[À REMPLACER : ajoutez des questions depuis le back-office.]</p>
        @endforelse
    </div>
</section>

{{-- ===================== CTA ===================== --}}
<section class="section-sm bg-khara-cream">
    <div class="section-container text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl kc-reveal">Une autre question ?</h2>
        <p class="mt-4 text-lg text-khara-gray-600 kc-reveal kc-reveal-2">Notre équipe vous répond sous 24 h.</p>
        <div class="mt-8 kc-reveal kc-reveal-3">
            <x-ui.button :href="route('contact')" variant="primary-lg">Nous contacter</x-ui.button>
        </div>
    </div>
</section>

@endsection
