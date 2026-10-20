@extends('layouts.admin')

@section('title', 'Gestion des Pages - Admin Khara Consulting')
@section('page-title', 'Gestion des pages')

@section('header-search')
<form action="{{ route('admin.pages.index') }}" method="GET" class="relative">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
    <input name="search" class="w-full bg-slate-100 border-none rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-khara-red/20 focus:outline-none" placeholder="Rechercher des pages..." type="text" value="{{ request('search') }}"/>
</form>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-khara-slate">Gestion des pages</h2>
            <p class="text-sm text-slate-500 mt-1">Gérez le contenu des pages du site</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="bg-khara-red hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-colors shrink-0">
            <span class="material-symbols-outlined text-lg">add</span>
            Créer une page
        </a>
    </div>

    <div class="admin-card overflow-hidden !p-0">
        @if($pages->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Titre</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Slug</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Dernière modification</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Actif</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pages as $page)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded bg-khara-red/10 flex items-center justify-center text-khara-red">
                                    @php
                                        $icon = in_array($page->slug, ['home', 'accueil']) ? 'home' : (in_array($page->slug, ['about', 'a-propos', 'about-us']) ? 'info' : (in_array($page->slug, ['services']) ? 'construction' : (in_array($page->slug, ['contact']) ? 'mail' : 'description')));
                                    @endphp
                                    <span class="material-symbols-outlined text-lg">{{ $icon }}</span>
                                </div>
                                <span class="font-semibold text-sm">{{ $page->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">/{{ $page->slug }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $page->updated_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <form action="{{ route('admin.pages.toggle', $page) }}" method="POST" class="inline">
                                    @csrf
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" {{ $page->is_active ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-khara-red"></div>
                                    </label>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $page->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $page->is_active ? 'Publié' : 'Brouillon' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="p-1.5 text-slate-400 hover:text-khara-red hover:bg-khara-red/10 rounded-lg transition-all" title="Modifier le contenu">
                                    <span class="material-symbols-outlined text-xl">edit_note</span>
                                </a>
                                <a href="{{ route('admin.pages.edit', $page) }}#meta" class="p-1.5 text-slate-400 hover:text-khara-red hover:bg-khara-red/10 rounded-lg transition-all" title="Paramètres SEO">
                                    <span class="material-symbols-outlined text-xl">settings</span>
                                </a>
                                @php
                                    $previewUrl = in_array($page->slug, ['home', 'accueil']) ? url('/') : url('/' . $page->slug);
                                @endphp
                                <a href="{{ $previewUrl }}" target="_blank" class="p-1.5 text-slate-400 hover:text-khara-red hover:bg-khara-red/10 rounded-lg transition-all" title="Aperçu">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex items-center justify-between px-6 pb-6 flex-wrap gap-4">
                <p class="text-sm text-slate-500">
                    Affichage de {{ $pages->firstItem() ?? 0 }} à {{ $pages->lastItem() ?? 0 }} sur {{ $pages->total() }} entrées
                </p>
                <div class="flex items-center gap-2">
                    {{ $pages->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-5xl text-slate-300 mb-4 block">description</span>
                <p class="text-slate-600 font-medium mb-2">Aucune page</p>
                <p class="text-slate-500 text-sm mb-6">Créez votre première page pour commencer</p>
                <a href="{{ route('admin.pages.create') }}" class="bg-khara-red hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold inline-flex items-center gap-2 transition-colors">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Créer une page
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
