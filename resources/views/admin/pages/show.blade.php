@extends('layouts.admin')

@section('title', 'Détails Page - Admin Khara Consulting')
@section('page-title', 'Détails Page')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
            <span class="material-symbols-outlined text-lg mr-1">arrow_back</span>
            Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="admin-card">
                <h2 class="text-2xl font-display font-bold text-khara-slate mb-6">Informations</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Slug</label>
                        <p class="text-lg font-mono text-khara-slate font-sans">{{ $page->slug }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Titre</label>
                        <p class="text-lg font-display font-bold text-khara-slate">{{ $page->title }}</p>
                    </div>
                    
                    @if($page->hero_title)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Titre Hero</label>
                        <p class="text-khara-slate font-sans">{{ $page->hero_title }}</p>
                    </div>
                    @endif
                    
                    @if($page->hero_subtitle)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Sous-titre Hero</label>
                        <p class="text-khara-slate font-sans">{{ $page->hero_subtitle }}</p>
                    </div>
                    @endif
                    
                    @if($page->hero_image)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Image Hero</label>
                        <img src="{{ asset('storage/' . $page->hero_image) }}" 
                             alt="Hero" 
                             class="w-full max-w-md rounded-lg">
                    </div>
                    @endif
                    
                    @if($page->content)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Contenu</label>
                        <div class="text-khara-slate font-sans prose max-w-none">
                            {!! $page->content !!}
                        </div>
                    </div>
                    @endif
                    
                    @if($page->mission)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Mission</label>
                        <p class="text-khara-slate font-sans">{{ $page->mission }}</p>
                    </div>
                    @endif
                    
                    @if($page->vision)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Vision</label>
                        <p class="text-khara-slate font-sans">{{ $page->vision }}</p>
                    </div>
                    @endif
                    
                    @if($page->values && is_array($page->values))
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Valeurs</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($page->values as $value)
                                <span class="px-3 py-1 bg-khara-red/10 text-khara-red rounded-lg font-sans font-medium text-sm">
                                    {{ $value }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <div class="admin-card">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Détails</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Statut</label>
                        @if($page->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-sans font-semibold">Actif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-sans font-semibold">Inactif</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Créé le</label>
                        <p class="text-khara-slate font-sans">{{ $page->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Modifié le</label>
                        <p class="text-khara-slate font-sans">{{ $page->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="admin-card mt-6">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="block w-full admin-btn-primary text-center">
                        Modifier
                    </a>
                    <form action="{{ route('admin.pages.destroy', $page) }}" 
                          method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full admin-btn-danger py-3">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

