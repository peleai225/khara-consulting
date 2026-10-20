@extends('layouts.app')

@section('title', ($page->meta_title ?: $page->title) . ' — ' . ($siteName ?? 'Khara Consulting'))
@section('description', $page->meta_description ?: '')

@section('content')

<section class="relative overflow-hidden bg-khara-cream">
    <x-brand.petal class="absolute -right-40 -top-32 w-[40rem] h-[40rem] text-khara-red opacity-[0.05] pointer-events-none" />
    @if($page->hero_image)
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $page->hero_image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover opacity-20">
        </div>
    @endif
    <div class="section-container relative z-10 py-16 md:py-24">
        <div class="max-w-3xl">
            <x-ui.eyebrow class="kc-reveal">{{ $page->title }}</x-ui.eyebrow>
            <h1 class="kc-reveal kc-reveal-2 mt-5 text-4xl sm:text-5xl lg:text-6xl text-khara-slate">
                {!! $page->hero_title ?: e($page->title) !!}
            </h1>
            @if($page->hero_subtitle)
                <p class="kc-reveal kc-reveal-3 mt-6 text-lg text-khara-gray-600 leading-relaxed">{{ $page->hero_subtitle }}</p>
            @endif
        </div>
    </div>
</section>

@if($page->content || $page->mission || $page->vision || !empty($page->values))
<section class="section bg-khara-white-off">
    <div class="section-container max-w-3xl space-y-8">
        @if($page->content)
            <div class="text-khara-gray-700 leading-relaxed text-lg whitespace-pre-line">{!! $page->content !!}</div>
        @endif

        @if($page->mission || $page->vision)
            <div class="grid md:grid-cols-2 gap-6">
                @if($page->mission)
                    <x-ui.card><x-ui.eyebrow>Mission</x-ui.eyebrow><p class="mt-3 text-khara-slate leading-relaxed">{{ $page->mission }}</p></x-ui.card>
                @endif
                @if($page->vision)
                    <x-ui.card><x-ui.eyebrow tone="gold">Vision</x-ui.eyebrow><p class="mt-3 text-khara-slate leading-relaxed">{{ $page->vision }}</p></x-ui.card>
                @endif
            </div>
        @endif

        @if(!empty($page->values))
            <div class="flex flex-wrap gap-3">
                @foreach($page->values as $value)
                    <x-ui.badge tone="gold">{{ $value }}</x-ui.badge>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif

<section class="section-sm bg-khara-cream">
    <div class="section-container text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl kc-reveal">Parlons de votre projet</h2>
        <div class="mt-8 kc-reveal kc-reveal-2"><x-ui.button :href="route('contact')" variant="primary-lg">Nous contacter</x-ui.button></div>
    </div>
</section>

@endsection
