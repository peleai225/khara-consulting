@extends('layouts.admin')

@section('title', 'Détails Service - Admin Khara Consulting')
@section('page-title', 'Détails Service')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="inline-flex items-center text-khara-red hover:text-khara-red-dark font-semibold">
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
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Titre</label>
                        <p class="text-lg font-display font-bold text-khara-slate">{{ $service->title }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Slug</label>
                        <p class="text-khara-slate font-sans">{{ $service->slug }}</p>
                    </div>
                    
                    @if($service->description)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Description</label>
                        <p class="text-khara-slate font-sans">{{ $service->description }}</p>
                    </div>
                    @endif
                    
                    @if($service->content)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Contenu</label>
                        <div class="text-khara-slate font-sans prose max-w-none">
                            {!! $service->content !!}
                        </div>
                    </div>
                    @endif
                    
                    @if($service->image)
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Image</label>
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ $service->title }}" 
                             class="w-full max-w-md rounded-lg">
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
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Icône</label>
                        <p class="text-khara-slate font-sans">{{ $service->icon ?? 'Non définie' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Ordre</label>
                        <p class="text-khara-slate font-sans">{{ $service->order }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Statut</label>
                        @if($service->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-sans font-semibold">Actif</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-sans font-semibold">Inactif</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-khara-gray-600 mb-1 font-sans">Créé le</label>
                        <p class="text-khara-slate font-sans">{{ $service->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="admin-card mt-6">
                <h3 class="text-xl font-display font-bold text-khara-slate mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.services.edit', $service) }}" class="block w-full admin-btn-primary text-center">
                        Modifier
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" 
                          method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
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

