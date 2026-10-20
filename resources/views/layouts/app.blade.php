<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $metaTitle ?? ($siteName ?? 'Khara Consulting') . ' — Beyond and Further')</title>
    <meta name="description" content="@yield('description', $metaDescription ?? 'Khara Consulting forme, structure et propulse les entreprises et entrepreneurs d\'Afrique francophone.')">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $metaTitle ?? ($siteName ?? 'Khara Consulting'))">
    <meta property="og:description" content="@yield('description', $metaDescription ?? 'Formation, accompagnement et conseil stratégique en Afrique francophone.')">
    <meta property="og:image" content="{{ asset('brand/khara-logo.png') }}">
    <meta property="og:site_name" content="{{ $siteName ?? 'Khara Consulting' }}">
    <meta property="og:locale" content="fr_FR">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $metaTitle ?? ($siteName ?? 'Khara Consulting'))">
    <meta name="twitter:description" content="@yield('description', $metaDescription ?? 'Formation, accompagnement et conseil stratégique en Afrique francophone.')">
    <meta name="twitter:image" content="{{ asset('brand/khara-logo.png') }}">

    <meta name="keywords" content="@yield('keywords', $metaKeywords ?? 'formation professionnelle, consulting, accompagnement entrepreneurial, Afrique, Côte d\'Ivoire, RH, recrutement')">
    <meta name="author" content="{{ $siteName ?? 'Khara Consulting' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    @if(!empty($siteFavicon ?? ''))
        <link rel="icon" href="{{ asset('storage/' . $siteFavicon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" type="image/png" href="{{ asset('brand/khara-logo.png') }}">
    @endif

    {{-- Polices : Playfair Display (titres) + Manrope (corps) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    {{-- Données structurées --}}
    @php
        $orgJsonLd = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $siteName ?? 'Khara Consulting',
            'url' => url('/'),
            'logo' => asset('brand/khara-logo.png'),
            'slogan' => $siteSlogan ?? 'Beyond and Further',
            'description' => "Cabinet de formation, d'accompagnement entrepreneurial et de conseil stratégique en Afrique francophone.",
            'telephone' => $sitePhone ?? null,
            'email' => $siteEmail ?? null,
            'areaServed' => 'Afrique francophone',
        ], fn ($v) => !empty($v));
    @endphp
    <script type="application/ld+json">{!! json_encode($orgJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @if(!empty($siteGoogleAnalytics ?? ''))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteGoogleAnalytics }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', @json($siteGoogleAnalytics));
        </script>
    @endif
</head>
<body class="bg-khara-white-off text-khara-slate antialiased min-h-screen flex flex-col">

    <a href="#contenu" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:top-4 focus:left-4 focus:bg-khara-red focus:text-white focus:px-5 focus:py-3 focus:rounded-full focus:font-semibold">
        Aller au contenu
    </a>

    {{-- ======================= HEADER ======================= --}}
    <header class="sticky top-0 z-50 bg-khara-white-off/85 backdrop-blur-xl border-b border-khara-gray-200/70">
        <nav class="section-container" aria-label="Navigation principale">
            <div class="flex items-center justify-between h-24">
                <x-brand.logo height="h-14" />

                <div class="hidden lg:flex items-center gap-9">
                    @php
                        $nav = [
                            ['home', 'Accueil'],
                            ['services', 'Services'],
                            ['realisations', 'Réalisations'],
                            ['about', 'À propos'],
                            ['programs', 'Programmes'],
                            ['faq', 'FAQ'],
                        ];
                    @endphp
                    @foreach ($nav as [$route, $label])
                        <a href="{{ route($route) }}"
                           class="link-underline text-[15px] font-semibold transition-colors {{ request()->routeIs($route) ? 'text-khara-red' : 'text-khara-slate hover:text-khara-red' }}"
                           {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!}>
                            {{ $label }}
                        </a>
                    @endforeach
                    <x-ui.button :href="route('contact')" variant="primary" class="!px-6 !py-3 text-[15px]">
                        Demander un devis
                    </x-ui.button>
                </div>

                <button id="mobile-menu-button" type="button"
                        class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-xl text-khara-slate hover:bg-khara-gray-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-khara-red/40"
                        aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobile-menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    {{-- ===================== MENU MOBILE ===================== --}}
    <div id="mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden" role="dialog" aria-modal="true" aria-label="Menu">
        <div id="mobile-menu-overlay" class="absolute inset-0 bg-khara-slate-darker/50 backdrop-blur-sm"></div>
        <div class="absolute inset-y-0 right-0 w-full max-w-sm bg-khara-white-off shadow-2xl flex flex-col p-6">
            <div class="flex items-center justify-between mb-8">
                <x-brand.logo height="h-10" :linked="false" />
                <button id="mobile-menu-close" type="button"
                        class="p-2.5 rounded-xl text-khara-slate hover:bg-khara-gray-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-khara-red/40"
                        aria-label="Fermer le menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-1" aria-label="Navigation mobile">
                @foreach ($nav as [$route, $label])
                    <a href="{{ route($route) }}"
                       class="px-4 py-3.5 rounded-xl text-lg font-semibold transition-colors {{ request()->routeIs($route) ? 'bg-khara-red-50 text-khara-red' : 'text-khara-slate hover:bg-khara-gray-100' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
            <div class="mt-auto pt-6">
                <x-ui.button :href="route('contact')" variant="primary" class="w-full">Demander un devis</x-ui.button>
                @if(!empty($sitePhone))
                    <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}" class="mt-3 flex items-center justify-center gap-2 text-khara-gray-600 font-semibold">
                        <svg class="w-5 h-5 text-khara-red" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a.75.75 0 0 1-.936.258 11.59 11.59 0 0 1-5.12-5.12.75.75 0 0 1 .258-.936l1.293-.97a1.125 1.125 0 0 0 .417-1.173L8.84 4.78a1.125 1.125 0 0 0-1.091-.852H6.375A2.25 2.25 0 0 0 4.125 6.18"/></svg>
                        {{ $sitePhone }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- ===================== FLASH ===================== --}}
    @if (session('success') || session('error'))
        <div class="section-container pt-4">
            @if (session('success'))
                <div role="status" class="flex items-start gap-3 rounded-[var(--radius-kc-md)] border border-green-200 bg-green-50 text-green-800 px-5 py-4">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div role="alert" class="flex items-start gap-3 rounded-[var(--radius-kc-md)] border border-khara-red-200 bg-khara-red-50 text-khara-red-800 px-5 py-4">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif
        </div>
    @endif

    {{-- ===================== CONTENU ===================== --}}
    <main id="contenu" class="relative flex-1">
        @yield('content')
    </main>

    {{-- ===================== FOOTER ===================== --}}
    <footer class="bg-khara-slate-darker text-white/70 mt-auto">
        <div class="section-container py-16 lg:py-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="flex flex-col gap-5">
                <x-brand.logo chip height="h-9" />
                <p class="text-sm leading-relaxed text-white/60 max-w-xs">
                    Khara Consulting forme, structure et propulse les entreprises et les entrepreneurs d'Afrique francophone. <span class="text-white/80 font-semibold">{{ $siteSlogan ?? 'Beyond and Further' }}.</span>
                </p>
                <div class="flex gap-3">
                    @php
                        $socials = array_filter([
                            'facebook' => $socialFacebook ?? '',
                            'linkedin' => $socialLinkedin ?? '',
                            'instagram' => $socialInstagram ?? '',
                            'youtube' => $socialYoutube ?? '',
                        ]);
                        $socialPaths = [
                            'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
                            'linkedin' => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
                            'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
                            'youtube' => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>',
                        ];
                    @endphp
                    @forelse ($socials as $net => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                           class="size-10 rounded-full border border-white/15 flex items-center justify-center text-white/70 hover:bg-khara-red hover:border-khara-red hover:text-white transition-all"
                           aria-label="{{ ucfirst($net) }}">
                            <svg class="w-4.5 h-4.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $socialPaths[$net] !!}</svg>
                        </a>
                    @empty
                        <span class="text-xs text-white/30">[À REMPLACER : liens réseaux sociaux]</span>
                    @endforelse
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider">Navigation</h4>
                <a href="{{ route('home') }}" class="text-sm hover:text-khara-gold transition-colors">Accueil</a>
                <a href="{{ route('about') }}" class="text-sm hover:text-khara-gold transition-colors">À propos</a>
                <a href="{{ route('services') }}" class="text-sm hover:text-khara-gold transition-colors">Nos services</a>
                <a href="{{ route('realisations') }}" class="text-sm hover:text-khara-gold transition-colors">Réalisations</a>
                <a href="{{ route('programs') }}" class="text-sm hover:text-khara-gold transition-colors">Programmes</a>
                <a href="{{ route('faq') }}" class="text-sm hover:text-khara-gold transition-colors">FAQ</a>
                <a href="{{ route('contact') }}" class="text-sm hover:text-khara-gold transition-colors">Contact</a>
            </div>

            <div class="flex flex-col gap-4">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider">Nos expertises</h4>
                @forelse (($footerServices ?? []) as $service)
                    <a href="{{ route('services') }}#{{ $service->slug ?? 'service-' . $service->id }}" class="text-sm hover:text-khara-gold transition-colors">{{ $service->title }}</a>
                @empty
                    <a href="{{ route('services') }}" class="text-sm hover:text-khara-gold transition-colors">Nos services</a>
                @endforelse
            </div>

            <div class="flex flex-col gap-4">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider">Contact</h4>
                @if(!empty($siteAddress))
                    <p class="text-sm flex items-start gap-2.5">
                        <svg class="w-4 h-4 mt-0.5 text-khara-gold flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6-5.686-6-10a6 6 0 1 1 12 0c0 4.314-6 10-6 10z"/><circle cx="12" cy="11" r="2"/></svg>
                        {{ $siteAddress }}
                    </p>
                @else
                    <p class="text-sm text-white/40">[À REMPLACER : adresse du bureau]</p>
                @endif
                @if(!empty($sitePhone))
                    <a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}" class="text-sm flex items-center gap-2.5 hover:text-khara-gold transition-colors">
                        <svg class="w-4 h-4 text-khara-gold flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a.75.75 0 0 1-.936.258 11.59 11.59 0 0 1-5.12-5.12.75.75 0 0 1 .258-.936l1.293-.97a1.125 1.125 0 0 0 .417-1.173L8.84 4.78a1.125 1.125 0 0 0-1.091-.852H6.375A2.25 2.25 0 0 0 4.125 6.18"/></svg>
                        {{ $sitePhone }}
                    </a>
                @endif
                @if(!empty($siteEmail))
                    <a href="mailto:{{ $siteEmail }}" class="text-sm flex items-center gap-2.5 hover:text-khara-gold transition-colors">
                        <svg class="w-4 h-4 text-khara-gold flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/></svg>
                        {{ $siteEmail }}
                    </a>
                @endif
            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="section-container py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
                <p>&copy; {{ date('Y') }} {{ $siteName ?? 'Khara Consulting' }}. Tous droits réservés.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('legal.mentions') }}" class="hover:text-white transition-colors">Mentions légales</a>
                    <a href="{{ route('legal.privacy') }}" class="hover:text-white transition-colors">Confidentialité</a>
                    <span class="text-white/30">Conception : PeleAI &amp; Bouagroupe</span>
                </div>
            </div>
        </div>
    </footer>

    <x-ui.whatsapp />

    <script>
        (function () {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            const close = document.getElementById('mobile-menu-close');
            const overlay = document.getElementById('mobile-menu-overlay');
            if (!btn || !menu) return;

            const open = () => { menu.classList.remove('hidden'); btn.setAttribute('aria-expanded', 'true'); document.body.style.overflow = 'hidden'; };
            const hide = () => { menu.classList.add('hidden'); btn.setAttribute('aria-expanded', 'false'); document.body.style.overflow = ''; };

            btn.addEventListener('click', open);
            close?.addEventListener('click', hide);
            overlay?.addEventListener('click', hide);
            menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', hide));
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !menu.classList.contains('hidden')) hide(); });
        })();
    </script>

    @stack('scripts')
</body>
</html>
