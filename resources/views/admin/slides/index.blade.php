@extends('layouts.admin')

@section('title', 'Gestion des Slides - Admin Khara Consulting')
@section('page-title', 'Gestion des slides')

@section('header-search')
<form action="{{ route('admin.slides.index') }}" method="GET" class="relative">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
    <input name="search" class="w-full bg-slate-100 border-none rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-khara-red/20 focus:outline-none" placeholder="Rechercher des slides..." type="text" value="{{ request('search') }}"/>
</form>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-khara-slate">Gestion des slides</h2>
            <p class="text-sm text-slate-500 mt-1">Gérez le carousel hero de la page d'accueil</p>
        </div>
        <a href="{{ route('admin.slides.create') }}" class="bg-khara-red hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-colors shrink-0">
            <span class="material-symbols-outlined text-lg">add</span>
            Créer un slide
        </a>
    </div>

    <div class="admin-card overflow-hidden !p-0">
        @if($slides->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Image</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Titre</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Ordre</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Dernière modification</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Actif</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($slides as $slide)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="size-12 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center shrink-0">
                                @if($slide->image)
                                    <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-slate-400">image</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-semibold text-sm">{{ $slide->title ?? 'Sans titre' }}</span>
                                @if($slide->subtitle)
                                    <span class="text-xs text-slate-500 truncate max-w-[200px]">{{ $slide->subtitle }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $slide->order }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $slide->updated_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <form action="{{ route('admin.slides.toggle', $slide) }}" method="POST" class="inline">
                                    @csrf
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" {{ $slide->is_active ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-khara-red"></div>
                                    </label>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $slide->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $slide->is_active ? 'Publié' : 'Brouillon' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.slides.edit', $slide) }}" class="p-1.5 text-slate-400 hover:text-khara-red hover:bg-khara-red/10 rounded-lg transition-all" title="Modifier">
                                    <span class="material-symbols-outlined text-xl">edit_note</span>
                                </a>
                                <a href="{{ route('home') }}#hero" target="_blank" class="p-1.5 text-slate-400 hover:text-khara-red hover:bg-khara-red/10 rounded-lg transition-all" title="Aperçu">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                </a>
                                <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce slide ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Supprimer">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex items-center justify-between px-6 pb-6 flex-wrap gap-4">
                <p class="text-sm text-slate-500">
                    Affichage de {{ $slides->firstItem() ?? 0 }} à {{ $slides->lastItem() ?? 0 }} sur {{ $slides->total() }} entrées
                </p>
                <div class="flex items-center gap-2">
                    {{ $slides->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-5xl text-slate-300 mb-4 block">slideshow</span>
                <p class="text-slate-600 font-medium mb-2">Aucun slide</p>
                <p class="text-slate-500 text-sm mb-6">Créez votre premier slide pour le carousel hero</p>
                <a href="{{ route('admin.slides.create') }}" class="bg-khara-red hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-bold inline-flex items-center gap-2 transition-colors">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Créer un slide
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
