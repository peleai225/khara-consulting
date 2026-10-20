<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Design System — Khara Consulting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-khara-white-off text-khara-slate antialiased">

    {{-- En-tête --}}
    <header class="bg-khara-slate-dark text-white">
        <div class="section-container py-10 flex items-center justify-between">
            <x-brand.logo :linked="false" chip height="h-10" />
            <span class="badge badge-ink">Design System v1</span>
        </div>
    </header>

    {{-- Couleurs --}}
    <section class="section">
        <div class="section-container">
            <x-ui.eyebrow>Fondations</x-ui.eyebrow>
            <h2 class="text-4xl md:text-5xl mt-4 mb-10">Palette</h2>

            <h3 class="text-xl mb-4 text-khara-gray-700">Rouge de marque <span class="text-khara-gray-500 text-base">(dérivé du logo #B70606)</span></h3>
            <div class="grid grid-cols-3 sm:grid-cols-6 lg:grid-cols-11 gap-2 mb-10">
                @foreach (['50','100','200','300','400','500','600','700','800','900','950'] as $s)
                    <div>
                        <div class="h-16 rounded-xl border border-khara-gray-200" style="background: var(--color-khara-red-{{ $s }})"></div>
                        <div class="mt-1 text-xs text-center text-khara-gray-500">{{ $s }}</div>
                    </div>
                @endforeach
            </div>

            <h3 class="text-xl mb-4 text-khara-gray-700">Accent & encre</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3 mb-10">
                @foreach ([
                    ['Or', 'bg-khara-gold', '#C9A227'],
                    ['Or foncé', 'bg-khara-gold-dark', '#9C7C18'],
                    ['Encre', 'bg-khara-slate', '#262323'],
                    ['Sombre', 'bg-khara-slate-dark', '#1C1212'],
                    ['Crème', 'bg-khara-cream border border-khara-gray-200', '#FEF5F4'],
                    ['Fond', 'bg-khara-white-off border border-khara-gray-200', '#FAF8F7'],
                ] as [$name, $cls, $hex])
                    <div>
                        <div class="h-16 rounded-xl {{ $cls }}"></div>
                        <div class="mt-1 text-xs text-center text-khara-gray-600">{{ $name }}<br><span class="text-khara-gray-400">{{ $hex }}</span></div>
                    </div>
                @endforeach
            </div>

            <h3 class="text-xl mb-4 text-khara-gray-700">Neutres chauds</h3>
            <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-9 gap-2">
                @foreach (['100','200','300','400','500','600','700','800','900'] as $s)
                    <div>
                        <div class="h-12 rounded-lg border border-khara-gray-200" style="background: var(--color-khara-gray-{{ $s }})"></div>
                        <div class="mt-1 text-xs text-center text-khara-gray-500">{{ $s }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Typographie --}}
    <section class="section bg-khara-cream">
        <div class="section-container">
            <x-ui.eyebrow tone="gold">Typographie</x-ui.eyebrow>
            <h2 class="text-4xl md:text-5xl mt-4 mb-10">Playfair Display + Manrope</h2>
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="space-y-4">
                    <h1 class="text-5xl">Beyond and Further</h1>
                    <h2 class="text-4xl">Titre de section</h2>
                    <h3 class="text-3xl">Sous-titre</h3>
                    <h4 class="text-2xl">Intertitre</h4>
                    <p class="text-sm text-khara-gray-500">Titres — Playfair Display</p>
                </div>
                <div class="space-y-4">
                    <p class="text-lg leading-relaxed text-khara-gray-700" style="max-width:34rem">
                        Khara Consulting accompagne les entreprises et les entrepreneurs d'Afrique francophone
                        dans leur formation, leur structuration et leur croissance. Un texte courant pensé
                        pour la lisibilité sur mobile, même en connexion instable.
                    </p>
                    <p><a href="#" class="link-underline text-khara-red font-semibold">Un lien de corps souligné</a></p>
                    <p class="text-sm text-khara-gray-500">Corps — Manrope, 1.125rem, interligne 1.6</p>
                    <div class="chevron-rule pt-4"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Composants --}}
    <section class="section">
        <div class="section-container">
            <x-ui.eyebrow>Composants</x-ui.eyebrow>
            <h2 class="text-4xl md:text-5xl mt-4 mb-10">Éléments d'interface</h2>

            <div class="flex flex-wrap gap-4 mb-8 items-center">
                <x-ui.button variant="primary">Demander un devis gratuit</x-ui.button>
                <x-ui.button variant="secondary">Nos réalisations</x-ui.button>
                <x-ui.button variant="gold">Accent or</x-ui.button>
                <x-ui.button variant="primary-lg">Parler de mon projet</x-ui.button>
            </div>

            <div class="flex flex-wrap gap-3 mb-10">
                <x-ui.badge>Formation</x-ui.badge>
                <x-ui.badge tone="gold">Premium</x-ui.badge>
                <span class="badge badge-ink bg-khara-slate text-white">Ink</span>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <x-ui.card>
                    <div class="kc-check mb-4">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="text-2xl mb-2">Carte standard</h3>
                    <p class="text-khara-gray-600">Surface nette, bord fin, lift doux au survol.</p>
                </x-ui.card>
                <x-ui.card feature petal>
                    <x-ui.eyebrow>Feature</x-ui.eyebrow>
                    <h3 class="text-2xl mt-3 mb-2">Carte à pétale</h3>
                    <p class="text-khara-gray-600">Motif signature en filigrane, discret.</p>
                </x-ui.card>
                <div class="card bg-khara-slate-dark text-white border-0">
                    <h3 class="text-2xl mb-2 text-white">Sur fond sombre</h3>
                    <p class="text-white/80">Inversion propre pour sections sombres et footer.</p>
                    <div class="mt-4"><x-ui.button variant="outline">En savoir plus</x-ui.button></div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-10 items-start">
                <div class="space-y-4 max-w-md">
                    <div>
                        <label class="input-label" for="ds-name">Nom complet</label>
                        <input id="ds-name" class="input" type="text" placeholder="Votre nom">
                    </div>
                    <div>
                        <label class="input-label" for="ds-mail">Email</label>
                        <input id="ds-mail" class="input" type="email" placeholder="vous@exemple.ci">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <x-ui.stat value="12+" label="Années" />
                    <x-ui.stat value="200+" label="Clients" />
                    <x-ui.stat value="95%" label="Satisfaction" />
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-khara-slate-darker text-white/70 py-10 text-center text-sm">
        Design System — Khara Consulting · page de démonstration (non indexée)
    </footer>
</body>
</html>
