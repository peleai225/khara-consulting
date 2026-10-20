<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Khara Consulting')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/image-preview.js'])
    <style>
        body { font-family: 'Manrope', sans-serif; }
        .admin-title { font-family: 'Playfair Display', serif; letter-spacing: -0.01em; }
    </style>
    @stack('styles')
</head>
<body class="bg-khara-white-off text-khara-slate antialiased font-[Manrope]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-khara-gray-200 flex flex-col sticky top-0 h-screen flex-shrink-0">
            <div class="px-5 pt-6 pb-4 border-b border-khara-gray-100">
                <a href="{{ route('admin.dashboard') }}" class="block" aria-label="Khara Consulting — tableau de bord">
                    <img src="{{ asset('brand/khara-logo.png') }}" alt="Khara Consulting" class="h-14 w-auto object-contain">
                </a>
                <p class="mt-3 text-[10px] text-khara-gray-500 font-semibold uppercase tracking-[0.18em]">Back-office</p>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.contacts.*') ? 'active-fill' : '' }}">contacts</span>
                    <span>Contacts</span>
                    @php $unreadCount = \App\Models\Contact::where('email_sent', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-khara-red text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">business_center</span>
                    <span>Services</span>
                </a>
                <a href="{{ route('admin.slides.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.slides.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">collections</span>
                    <span>Slides</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">format_quote</span>
                    <span>Testimonials</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.faqs.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">quiz</span>
                    <span>FAQ</span>
                </a>
                <a href="{{ route('admin.realisations.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.realisations.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">workspace_premium</span>
                    <span>Réalisations</span>
                </a>
                <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.programs.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">school</span>
                    <span>Programmes</span>
                </a>
                <a href="{{ route('admin.team.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.team.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">groups</span>
                    <span>Équipe</span>
                </a>
                <a href="{{ route('admin.stats.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.stats.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">trending_up</span>
                    <span>Chiffres clés</span>
                </a>
                <a href="{{ route('admin.blocks.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.blocks.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined">dashboard_customize</span>
                    <span>Contenus</span>
                </a>
                <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.pages.*') ? 'active-fill' : '' }}">description</span>
                    <span>Pages</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3 p-2">
                    <div class="size-10 rounded-full bg-khara-red flex items-center justify-center text-white font-bold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-khara-red p-1 transition-colors" title="Déconnexion">
                            <span class="material-symbols-outlined text-xl">logout</span>
                        </button>
                    </form>
                </div>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : '' }}">
                        <span class="material-symbols-outlined">settings</span>
                        <span class="text-sm">Settings</span>
                    </a>
                    @can('manage-users')
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-khara-red/10 text-khara-red font-semibold' : '' }}">
                        <span class="material-symbols-outlined">person</span>
                        <span class="text-sm">Utilisateurs</span>
                    </a>
                    @endcan
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined">home</span>
                        <span class="text-sm">Retour au site</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0">
            <!-- Header -->
            <header class="h-16 border-b border-slate-200 bg-white px-6 lg:px-8 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center flex-1 max-w-md">
                    @hasSection('header-search')
                        <div class="relative w-full">
                            @yield('header-search')
                        </div>
                    @else
                        <h2 class="admin-title text-xl font-bold text-khara-slate">@yield('page-title', 'Tableau de bord')</h2>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    @if(session('success'))
                        <div class="flex items-center gap-2 px-4 py-2 bg-green-50 border border-green-200 rounded-lg">
                            <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                            <span class="text-green-800 font-medium text-sm">{{ session('success') }}</span>
                        </div>
                    @endif
                    <button type="button" class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors" title="Notifications">
                        <span class="material-symbols-outlined">notifications</span>
                        @php $unreadNotifications = \App\Models\Contact::where('email_sent', false)->count(); @endphp
                        @if($unreadNotifications > 0)
                            <span class="absolute top-2 right-2 size-2 bg-khara-red rounded-full border-2 border-white"></span>
                        @endif
                    </button>
                    <a href="{{ route('admin.settings.index') }}" class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors" title="Paramètres">
                        <span class="material-symbols-outlined">settings</span>
                    </a>
                </div>
            </header>

            <!-- Content -->
            <div class="p-8 flex-1">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
